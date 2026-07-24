@extends('layouts.dosen')

@section('content-body')
<x-page-header title="Absensi" />

<div class="mb-4">
    <h2 class="font-semibold text-base-content">{{ $teachingAssignment->mataKuliah->nama }}</h2>
    <p class="text-sm text-base-content/50">{{ $teachingAssignment->mataKuliah->kode }} - {{ $teachingAssignment->kelas->kode }} - {{ $attendances->count() }}/{{ $teachingAssignment->kelas->mahasiswa->count() }} hadir</p>
</div>

<div class="overflow-x-auto rounded-xl bg-base-100 shadow">
    <table class="table table-zebra table-sm">
        <thead>
            <tr><th>NIM</th><th>Nama</th><th>Waktu Absen</th></tr>
        </thead>
        <tbody>
            @foreach ($teachingAssignment->kelas->mahasiswa as $mhs)
                @php $att = $attendances->where('mahasiswa_id', $mhs->id)->first(); @endphp
                <tr class="hover">
                    <td class="font-mono">{{ $mhs->nim }}</td>
                    <td>{{ $mhs->nama }}</td>
                    <td>
                        @if ($att)
                            <span class="badge badge-success badge-sm">{{ $att->attended_at->format('H:i') }}</span>
                        @else
                            <span class="badge badge-ghost badge-sm">Belum</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
