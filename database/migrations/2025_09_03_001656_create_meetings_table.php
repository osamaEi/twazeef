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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('platform', ['zoom', 'teams', 'meet', 'in_person'])->default('zoom');
            $table->string('meeting_link')->nullable();
            $table->string('meeting_id')->nullable(); // Platform-specific meeting ID
            $table->string('meeting_password')->nullable();
            $table->date('scheduled_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('timezone')->default('Asia/Riyadh');
            $table->enum('status', ['scheduled', 'in_progress', 'completed', 'cancelled', 'postponed'])->default('scheduled');
            $table->string('location')->nullable(); // For in-person meetings
            $table->json('attendees')->nullable(); // Array of user IDs and their status
            $table->json('settings')->nullable(); // Meeting settings (recording, waiting room, etc.)
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('company_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('application_id')->nullable()->constrained('applications')->onDelete('cascade');
            $table->unsignedBigInteger('calendar_event_id')->nullable();
            $table->json('recording_info')->nullable(); // Recording details if available
            $table->text('notes')->nullable(); // Meeting notes
            $table->timestamps();

            $table->index(['scheduled_date', 'start_time']);
            $table->index(['company_id', 'scheduled_date']);
            $table->index(['created_by', 'scheduled_date']);
            $table->index(['status', 'scheduled_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
