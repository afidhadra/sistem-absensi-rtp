<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Fakultas;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\ProgramStudi;
use App\Models\Semester;
use App\Models\TahunAkademik;
use App\Models\TeachingAssignment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // --- Master data ---
        $fakultas = Fakultas::create([
            'kode' => 'FTI',
            'nama' => 'Fakultas Teknik dan Informatika',
        ]);

        $prodi = ProgramStudi::create([
            'fakultas_id' => $fakultas->id,
            'kode' => 'TI',
            'nama' => 'Teknik Informatika',
        ]);

        $tahunAkademik = TahunAkademik::create([
            'kode' => '2024/2025-GANJIL',
            'nama' => 'Tahun Akademik 2024/2025 Ganjil',
            'tanggal_mulai' => '2024-09-01',
            'tanggal_selesai' => '2025-02-28',
            'is_active' => true,
        ]);

        $semester = Semester::create([
            'kode' => 'SEM-3',
            'nama' => 'Semester 3',
        ]);

        $kelas = Kelas::create([
            'kode' => 'TI-3A',
            'nama' => 'TI-3A',
            'program_studi_id' => $prodi->id,
        ]);

        $matkul = MataKuliah::create([
            'kode' => 'IF-301',
            'nama' => 'Pemrograman Web',
            'sks' => 4,
            'semester_id' => $semester->id,
            'program_studi_id' => $prodi->id,
            'is_active' => true,
        ]);

        // --- Users per role ---
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        $dosenUser = User::create([
            'name' => 'Dr. Budi Santoso',
            'email' => 'dosen',
            'password' => Hash::make('dosen123'),
            'role' => 'dosen',
        ]);

        $mhsUser = User::create([
            'name' => 'Ahmad Student',
            'email' => 'mahasiswa',
            'password' => Hash::make('mahasiswa123'),
            'role' => 'mahasiswa',
        ]);

        // --- Profile links ---
        Dosen::create([
            'user_id' => $dosenUser->id,
            'nip' => '198501012010011001',
            'nama' => 'Dr. Budi Santoso',
            'fakultas_id' => $fakultas->id,
        ]);

        $mahasiswa = Mahasiswa::create([
            'user_id' => $mhsUser->id,
            'nim' => '2021001',
            'nama' => 'Ahmad Student',
            'kelas_id' => $kelas->id,
        ]);

        // --- Teaching assignment ---
        $ta = TeachingAssignment::create([
            'dosen_id' => $dosenUser->dosen->id,
            'mata_kuliah_id' => $matkul->id,
            'kelas_id' => $kelas->id,
            'semester_id' => $semester->id,
            'tahun_akademik_id' => $tahunAkademik->id,
        ]);

        // --- Extra mahasiswa for class (10 more) ---
        User::factory(10)->create(['role' => 'mahasiswa'])->each(function (User $u) use ($kelas): void {
            Mahasiswa::create([
                'user_id' => $u->id,
                'nim' => '2021'.str_pad((string) ($u->id + 100), 3, '0', STR_PAD_LEFT),
                'nama' => $u->name,
                'kelas_id' => $kelas->id,
            ]);
        });
    }
}
