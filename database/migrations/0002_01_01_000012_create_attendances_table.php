<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa')->cascadeOnDelete();
            $table->foreignId('otp_id')->constrained('otps')->cascadeOnDelete();
            $table->foreignId('teaching_assignment_id')->constrained('teaching_assignments')->cascadeOnDelete();
            $table->timestamp('attended_at')->useCurrent();
            $table->timestamps();

            $table->unique(['mahasiswa_id', 'teaching_assignment_id'], 'att_unique_per_session');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
