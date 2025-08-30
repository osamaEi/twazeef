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
            // Company entity fields
            $table->string('entity_type')->nullable()->after('cv');
            $table->string('license_number')->nullable()->after('entity_type');
            $table->date('establishment_date')->nullable()->after('license_number');
            $table->string('business_sector')->nullable()->after('establishment_date');
            $table->string('entity_phone')->nullable()->after('business_sector');
            $table->string('entity_email')->nullable()->after('entity_phone');
            $table->text('entity_description')->nullable()->after('entity_email');

            // Responsible person fields
            $table->string('responsible_name')->nullable()->after('entity_description');
            $table->string('responsible_position')->nullable()->after('responsible_name');
            $table->string('responsible_id')->nullable()->after('responsible_position');
            $table->string('responsible_phone')->nullable()->after('responsible_id');
            $table->string('responsible_email')->nullable()->after('responsible_phone');
            $table->string('responsible_department')->nullable()->after('responsible_email');
            $table->text('authorization_scope')->nullable()->after('responsible_department');

            // Additional document fields
            $table->json('additional_documents')->nullable()->after('authorization_scope');
            $table->string('id_image')->nullable()->after('additional_documents');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'entity_type',
                'license_number',
                'establishment_date',
                'business_sector',
                'entity_phone',
                'entity_email',
                'entity_description',
                'responsible_name',
                'responsible_position',
                'responsible_id',
                'responsible_phone',
                'responsible_email',
                'responsible_department',
                'authorization_scope',
                'additional_documents',
                'id_image',
            ]);
        });
    }
};
