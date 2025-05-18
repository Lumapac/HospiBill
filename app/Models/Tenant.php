<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Illuminate\Support\Facades\DB;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'name',
            'email',
            'contact_person',
            'phone_number',
            'password',
            'status',
            'subscription',
            'admin_notes',
            'approved_at',
            'approved_by',
            'rejected_at',
            'rejected_by',
            'should_delete_database'
        ];
    }

    public function getStatusBadgeAttribute()
    {
        return match ($this->status) {
            'pending' => '<span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full">Pending</span>',
            'approved' => '<span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">Approved</span>',
            'disabled' => '<span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full">Disabled</span>',
            'rejected' => '<span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full">Rejected</span>',
            default => '<span class="px-2 py-1 text-xs font-semibold text-gray-800 bg-gray-100 rounded-full">Unknown</span>',
        };
    }
    
    /**
     * Check if the tenant's database has been created
     */
    public function databaseExists()
    {
        try {
            $dbName = $this->database()->getName();
            $exists = DB::select("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$dbName'");
            return !empty($exists);
        } catch (\Exception $e) {
            return false;
        }
    }
    
    /**
     * Boot method for model
     */
    protected static function boot()
    {
        parent::boot();
        
        // Prevent database creation if tenant has been rejected
        static::creating(function ($tenant) {
            if ($tenant->status === 'rejected') {
                return false;
            }
        });
        
        // Prevent domain creation if tenant has been rejected
        static::saved(function ($tenant) {
            if ($tenant->status === 'rejected' && $tenant->domains()->exists()) {
                $tenant->domains()->delete();
            }
        });
    }
}