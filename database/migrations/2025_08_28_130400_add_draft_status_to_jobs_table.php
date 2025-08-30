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
        // Use raw SQL to modify the enum column
        DB::statement("ALTER TABLE jobs MODIFY COLUMN status ENUM('active', 'paused', 'closed', 'draft') DEFAULT 'active'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to original enum values
        DB::statement("ALTER TABLE jobs MODIFY COLUMN status ENUM('active', 'paused', 'closed') DEFAULT 'active'");
    }
};
