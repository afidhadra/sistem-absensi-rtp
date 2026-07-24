<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'stats' => [
                'mahasiswa' => Mahasiswa::count(),
                'dosen' => Dosen::count(),
                'mata_kuliah' => MataKuliah::count(),
                'kelas' => Kelas::count(),
            ],
        ]);
    }
}
