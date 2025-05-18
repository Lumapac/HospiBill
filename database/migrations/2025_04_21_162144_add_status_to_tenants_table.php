<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            // Check if status column doesn't exist before adding
            if (!Schema::hasColumn('tenants', 'status')) {
                $table->enum('status', ['pending', 'approved', 'disabled'])->default('pending')->after('password');
            }
            
            // Add admin_notes column
            if (!Schema::hasColumn('tenants', 'admin_notes')) {
                $table->text('admin_notes')->nullable()->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            if (Schema::hasColumn('tenants', 'admin_notes')) {
                $table->dropColumn('admin_notes');
            }
            
            if (Schema::hasColumn('tenants', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
