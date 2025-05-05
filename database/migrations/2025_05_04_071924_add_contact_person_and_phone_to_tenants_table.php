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
            // Add contact_person and phone_number columns after email
            if (!Schema::hasColumn('tenants', 'contact_person')) {
                $table->string('contact_person')->after('email')->nullable();
            }

            if (!Schema::hasColumn('tenants', 'phone_number')) {
                $table->string('phone_number')->after('contact_person')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            if (Schema::hasColumn('tenants', 'phone_number')) {
                $table->dropColumn('phone_number');
            }
            
            if (Schema::hasColumn('tenants', 'contact_person')) {
                $table->dropColumn('contact_person');
            }
        });
    }
};
