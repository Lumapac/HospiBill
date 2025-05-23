<?php

namespace App\Http\Controllers\App;
use App\Mail\UsersCredentialsMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role as SpatieRole;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->get();
        $roles = SpatieRole::get();
        return view('app.users.index', compact('users', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $plainPassword = Str::random(10);
        $validatedData['password'] = bcrypt($plainPassword);

        $user = User::create($validatedData);

        $roleNames = SpatieRole::whereIn('id', $validatedData['roles'])->pluck('name');
        $user->assignRole($roleNames);

         // Send password via email
        Mail::to($user->email)->send(new UsersCredentialsMail($plainPassword, $user));

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = SpatieRole::get();
        // dd($users->toArray());
        return view('app.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $user->id,
                'roles' => 'required|array',
            ]);
            
            $user->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
            ]);
            
            $user->roles()->sync($request->input('roles'));
            
            return redirect()->route('users.index')->with('success', 'User updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('users.index')
                ->withErrors($e->validator)
                ->with('editing', true)
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
