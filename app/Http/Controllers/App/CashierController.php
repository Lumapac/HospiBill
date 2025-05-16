<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\Service;
use App\Mail\BillCreatedMail;
use App\Mail\PaymentConfirmationMail;
use App\Services\PdfService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CashierController extends Controller
{
    public function billing()
    {
        // Get patients who haven't been billed yet
        $recentPatients = Patient::with('service')
            ->whereDoesntHave('bills') // Only include patients without any bills
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        $pendingBills = Bill::with(['patient', 'service'])
            ->where('status', '!=', 'paid')
            ->orderBy('due_date', 'asc')
            ->paginate(10);
            
        $services = Service::orderBy('name')->get();
        
        // Get all patients for the create bill form
        $allPatients = Patient::orderBy('first_name')->get();
            
        return view('app.cashier.billing', compact(
            'recentPatients',
            'pendingBills',
            'services',
            'allPatients'
        ));
    }
    
    public function createBill(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'service_id' => 'required|exists:services,id',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date|after_or_equal:today',
            'notes' => 'nullable|string',
        ]);
        
        // Get the patient and service information
        $patient = Patient::with('service')->findOrFail($validated['patient_id']);
        $service = Service::findOrFail($validated['service_id']);
        
        // Generate a unique bill number
        $billNumber = 'BILL-' . strtoupper(Str::random(6));
        
        // Create the bill
        $bill = Bill::create([
            'bill_number' => $billNumber,
            'patient_id' => $patient->id,
            'service_id' => $service->id,
            'amount' => $validated['amount'],
            'due_date' => $validated['due_date'],
            'notes' => $validated['notes'],
            'status' => 'pending',
        ]);
        
        // Load the relationships for the email/PDF
        $bill->load(['patient', 'service']);
        
        // Send the bill to the patient's email if it's available
        if ($patient->email) {
            try {
                Mail::to($patient->email)->send(new BillCreatedMail($bill));
                $successMessage = 'Bill created successfully for ' . $patient->full_name . ' and sent to their email.';
            } catch (\Exception $e) {
                // Log the error but don't fail the request
                Log::error('Failed to send bill email: ' . $e->getMessage());
                $successMessage = 'Bill created successfully for ' . $patient->full_name . ', but there was an issue sending the email.';
            }
        } else {
            $successMessage = 'Bill created successfully for ' . $patient->full_name . '. No email was sent because the patient does not have an email address.';
        }
        
        // Redirect back to the billing page with a success message
        return redirect()->route('patient.bill')->with('success', $successMessage);
    }
    
    public function processPayment(Request $request, Bill $bill)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0.01|max:' . ($bill->amount - $bill->amount_paid),
            'payment_method' => 'required|in:cash,card,bank_transfer,other',
            'reference_number' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);
        
        // Create the payment record
        $payment = Payment::create([
            'bill_id' => $bill->id,
            'amount' => $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'reference_number' => $validated['reference_number'],
            'notes' => $validated['notes'],
            'cashier_id' => Auth::id(),
        ]);
        
        // Update the bill amount_paid and status
        $bill->amount_paid += $validated['amount'];
        
        if ($bill->amount_paid >= $bill->amount) {
            $bill->status = 'paid';
        } else {
            $bill->status = 'partially_paid';
        }
        
        $bill->save();
        
        // Load the relationships needed for the email
        $bill->load(['patient', 'service', 'payments.cashier']);
        
        // Send payment confirmation email if patient has an email
        $successMessage = 'Payment processed successfully.';
        
        if ($bill->patient->email) {
            try {
                Mail::to($bill->patient->email)->send(new PaymentConfirmationMail($bill, $payment));
                $successMessage = 'Payment processed successfully and confirmation sent to patient email.';
            } catch (\Exception $e) {
                // Log the error but don't fail the request
                Log::error('Failed to send payment confirmation email: ' . $e->getMessage());
                $successMessage = 'Payment processed successfully, but there was an issue sending the confirmation email.';
            }
        }
        
        return redirect()->route('patient.bill')->with('success', $successMessage);
    }
    
    public function viewBill(Bill $bill)
    {
        $bill->load(['patient', 'service', 'payments.cashier']);
        
        if (request()->wantsJson()) {
            return response()->json($bill);
        }
        
        return view('app.cashier.view-bill', compact('bill'));
    }
    
    public function getPatientServices(Patient $patient)
    {
        return response()->json([
            'service' => $patient->service,
        ]);
    }
    
    public function searchPatients(Request $request)
    {
        $search = $request->input('search');
        
        $patients = Patient::where('first_name', 'like', "%{$search}%")
            ->orWhere('last_name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->orWhere('phone', 'like', "%{$search}%")
            ->with('service')
            ->get();
            
        return response()->json($patients);
    }
    
    public function listAllBills()
    {
        $bills = Bill::with(['patient', 'service'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('app.cashier.all-bills', compact('bills'));
    }
    
    /**
     * Download a PDF of the bill
     */
    public function downloadBillPdf(Bill $bill)
    {
        $bill->load(['patient', 'service']);
        $pdfContent = PdfService::generateBillPdf($bill);
        
        return response($pdfContent)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="Bill_' . $bill->bill_number . '.pdf"');
    }
}
