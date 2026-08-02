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
        Schema::table('dosen', function (Blueprint $table) {
            $table->renameColumn('nip', 'nidn');
        });

        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->renameColumn('nim', 'npm');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dosen', function (Blueprint $table) {
            $table->renameColumn('nidn', 'nip');
        });

        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->renameColumn('npm', 'nim');
        });
    }
};
