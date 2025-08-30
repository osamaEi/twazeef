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
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name_ar')->nullable()->after('name');
            $table->string('last_name_ar')->nullable()->after('first_name_ar');
            $table->string('first_name_en')->nullable()->after('last_name_ar');
            $table->string('last_name_en')->nullable()->after('first_name_en');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'first_name_ar',
                'last_name_ar',
                'first_name_en',
                'last_name_en'
            ]);
        });
    }
};
