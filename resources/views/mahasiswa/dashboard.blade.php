@extends('layouts.mahasiswa')

@section('content-body')
@if (session('success'))
    <div class="mb-4 rounded-lg bg-green-50 p-4 text-center text-lg font-bold text-green-700">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="mb-4 rounded-lg bg-red-50 p-4 text-center text-red-700">{{ session('error') }}</div>
@endif

<h1 class="mb-2 text-2xl font-bold text-gray-800">Dashboard</h1>
<p class="mb-6 text-sm text-gray-500">{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }} — {{ $mahasiswa->kelas?->kode ?? '-' }}</p>

<div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
    {{-- Today schedule --}}
    <section>
        <h2 class="mb-3 text-lg font-semibold text-gray-800">Jadwal Hari Ini</h2>
        @forelse ($todaySchedule as $j)
            <div class="mb-3 rounded-lg border bg-white p-4 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-semibold text-gray-800">{{ $j->teachingAssignment->mataKuliah->nama }}</h3>
                        <p class="text-sm text-gray-500">{{ $j->teachingAssignment->dosen->nama }} — {{ substr($j->jam_mulai, 0, 5) }}-{{ substr($j->jam_selesai, 0, 5) }} ({{ $j->ruangan ?? '-' }})</p>
                    </div>
                    <div>
                        @if (in_array($j->teaching_assignment_id, $attendedTaIds))
                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700">Hadir</span>
                        @elseif (!empty($activeOtpsByTa[$j->teaching_assignment_id]))
                            <button onclick="document.getElementById('otp-{{ $j->id }}').classList.toggle('hidden')"
                                class="rounded bg-blue-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-blue-700">Absen</button>
                            <form id="otp-{{ $j->id }}" method="POST" action="{{ route('mahasiswa.absensi') }}" class="hidden mt-2">
                                @csrf
                                <input type="hidden" name="jadwal_id" value="{{ $j->id }}">
                                <input type="hidden" name="teaching_assignment_id" value="{{ $j->teaching_assignment_id }}">
                                <input type="text" name="kode" placeholder="Kode OTP" maxlength="6" class="w-full rounded border px-2 py-1 text-xs mb-1" required>
                                <button type="submit" class="w-full rounded bg-green-600 px-2 py-1 text-xs font-medium text-white hover:bg-green-700">Kirim</button>
                            </form>
                        @else
                            <span class="text-xs text-gray-400">Tidak ada OTP aktif</span>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p class="rounded-lg bg-white p-4 text-sm text-gray-500 shadow-sm">Tidak ada jadwal hari ini.</p>
        @endforelse
    </section>

    {{-- Stats --}}
    <section>
        <h2 class="mb-3 text-lg font-semibold text-gray-800">Kehadiran</h2>
        <div class="rounded-lg bg-white p-4 shadow-sm">
            @php $totalSessions = $todaySchedule->count() + $riwayat->count(); @endphp
            <p class="text-3xl font-bold text-gray-800">{{ $persentase }}%</p>
            <p class="text-sm text-gray-500">Kehadiran ({{ $riwayat->count() }} dari {{ $totalSessions }} sesi)</p>
            <div class="mt-3 h-2 w-full overflow-hidden rounded-full bg-gray-200">
                <div class="h-full rounded-full bg-green-500 transition-all" style="width: {{ $persentase }}%"></div>
            </div>
        </div>

        @if ($riwayat->isNotEmpty())
            <h3 class="mb-2 mt-6 text-sm font-semibold text-gray-700">Riwayat Terbaru</h3>
            <div class="overflow-hidden rounded-lg bg-white shadow-sm">
                <table class="w-full text-left text-xs">
                    <thead class="border-b bg-gray-50 text-gray-500 uppercase">
                        <tr><th class="px-3 py-2">Matkul</th><th class="px-3 py-2">Waktu</th></tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach ($riwayat->take(5) as $att)
                            <tr class="hover:bg-gray-50">
                                <td class="px-3 py-2">{{ $att->teachingAssignment?->mataKuliah?->nama ?? '-' }}</td>
                                <td class="px-3 py-2 text-gray-500">{{ $att->attended_at->format('d/m H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>
</div>
@endsection
