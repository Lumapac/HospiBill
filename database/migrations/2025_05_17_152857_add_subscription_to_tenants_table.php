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
            // Add subscription column
            if (!Schema::hasColumn('tenants', 'subscription')) {
                $table->enum('subscription', ['free', 'standard', 'premium'])->default('free')->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            if (Schema::hasColumn('tenants', 'subscription')) {
                $table->dropColumn('subscription');
            }
        });
    }
};
