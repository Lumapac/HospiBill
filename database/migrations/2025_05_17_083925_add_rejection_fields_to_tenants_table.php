<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            // Add rejected_at column
            if (!Schema::hasColumn('tenants', 'rejected_at')) {
                $table->timestamp('rejected_at')->nullable()->after('approved_by');
            }
            
            // Add rejected_by column
            if (!Schema::hasColumn('tenants', 'rejected_by')) {
                $table->string('rejected_by')->nullable()->after('rejected_at');
            }
            
            // Add should_delete_database flag
            if (!Schema::hasColumn('tenants', 'should_delete_database')) {
                $table->boolean('should_delete_database')->default(false)->after('rejected_by');
            }
            
            // Update status enum to include 'rejected'
            DB::statement("ALTER TABLE tenants MODIFY COLUMN status ENUM('pending', 'approved', 'disabled', 'rejected') DEFAULT 'pending'");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            if (Schema::hasColumn('tenants', 'should_delete_database')) {
                $table->dropColumn('should_delete_database');
            }
            
            if (Schema::hasColumn('tenants', 'rejected_by')) {
                $table->dropColumn('rejected_by');
            }
            
            if (Schema::hasColumn('tenants', 'rejected_at')) {
                $table->dropColumn('rejected_at');
            }
            
            // Revert status enum
            DB::statement("ALTER TABLE tenants MODIFY COLUMN status ENUM('pending', 'approved', 'disabled') DEFAULT 'pending'");
        });
    }
};
