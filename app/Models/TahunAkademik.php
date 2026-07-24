<?php

namespace App\Models;

use Database\Factories\TahunAkademikFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TahunAkademik extends Model
{
    /** @use HasFactory<TahunAkademikFactory> */
    use HasFactory;

    protected $table = 'tahun_akademik';

    protected $fillable = ['kode', 'nama', 'tanggal_mulai', 'tanggal_selesai', 'is_active'];

    protected function casts(): array
    {
        return [
            'tanggal_mulai' => 'date',
            'tanggal_selesai' => 'date',
            'is_active' => 'boolean',
        ];
    }

    /**
     * @return HasMany<TeachingAssignment, $this>
     */
    public function teachingAssignments(): HasMany
    {
        return $this->hasMany(TeachingAssignment::class);
    }
}
