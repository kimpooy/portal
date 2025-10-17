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
        Schema::table('applicants', function (Blueprint $table) {
            $table->string('address')->nullable()->change();
            $table->string('house_no')->nullable()->after('address');
            $table->string('street')->nullable()->after('house_no');
            $table->string('subdivision')->nullable()->after('street');
            $table->string('barangay')->nullable()->after('subdivision');
            $table->string('municipality')->nullable()->after('barangay');
            $table->string('city')->nullable()->after('municipality');
            $table->string('province')->nullable()->after('city');
            $table->string('country')->nullable()->after('province');
            $table->string('zip_code')->nullable()->after('country');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applicants', function (Blueprint $table) {
            $table->dropColumn(['address','house_no','street','subdivision','barangay','municipality', 'city', 'province', 'country', 'zip_code']);
        });
    }
};
