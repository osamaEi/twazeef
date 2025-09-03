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
        Schema::create('calendars', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('event_date');
            $table->time('start_time');
            $table->time('end_time')->nullable();
            $table->enum('type', ['meeting', 'interview', 'deadline', 'personal', 'other'])->default('meeting');
            $table->enum('status', ['scheduled', 'completed', 'cancelled', 'postponed'])->default('scheduled');
            $table->string('location')->nullable();
            $table->json('attendees')->nullable(); // Array of user IDs
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('company_id')->constrained('users')->onDelete('cascade'); // Company that owns this event
            $table->foreignId('application_id')->nullable()->constrained('applications')->onDelete('cascade'); // Related job application
            $table->json('reminder_settings')->nullable(); // Reminder configuration
            $table->boolean('is_recurring')->default(false);
            $table->json('recurrence_pattern')->nullable(); // For recurring events
            $table->timestamps();

            $table->index(['event_date', 'start_time']);
            $table->index(['company_id', 'event_date']);
            $table->index(['created_by', 'event_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendars');
    }
};
