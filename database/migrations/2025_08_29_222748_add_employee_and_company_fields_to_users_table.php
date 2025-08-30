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
            // Employee fields
            $table->string('national_id')->nullable()->after('address');
            $table->date('birth_date')->nullable()->after('national_id');
            $table->enum('gender', ['male', 'female'])->nullable()->after('birth_date');
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed'])->nullable()->after('gender');
            $table->enum('education', ['high-school', 'diploma', 'bachelor', 'master', 'phd'])->nullable()->after('marital_status');
            $table->string('specialization')->nullable()->after('education');
            $table->string('national_id_image')->nullable()->after('specialization');
            $table->string('certificate_image')->nullable()->after('national_id_image');
            $table->string('experience_certificate')->nullable()->after('certificate_image');
            $table->string('cv')->nullable()->after('experience_certificate');

            // Company fields
            $table->string('commercial_license')->nullable()->after('cv');
            $table->string('tax_certificate')->nullable()->after('commercial_license');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'national_id',
                'birth_date',
                'gender',
                'marital_status',
                'education',
                'specialization',
                'national_id_image',
                'certificate_image',
                'experience_certificate',
                'cv',
                'commercial_license',
                'tax_certificate',
            ]);
        });
    }
};
