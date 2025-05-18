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
            // Add approved_at column
            if (!Schema::hasColumn('tenants', 'approved_at')) {
                $table->timestamp('approved_at')->nullable()->after('admin_notes');
            }
            
            // Add approved_by column
            if (!Schema::hasColumn('tenants', 'approved_by')) {
                $table->string('approved_by')->nullable()->after('approved_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            if (Schema::hasColumn('tenants', 'approved_by')) {
                $table->dropColumn('approved_by');
            }
            
            if (Schema::hasColumn('tenants', 'approved_at')) {
                $table->dropColumn('approved_at');
            }
        });
    }
};
