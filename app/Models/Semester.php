<?php

namespace App\Models;

use Database\Factories\SemesterFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Semester extends Model
{
    /** @use HasFactory<SemesterFactory> */
    use HasFactory;

    protected $fillable = ['kode', 'nama'];

    /**
     * @return HasMany<MataKuliah, $this>
     */
    public function mataKuliah(): HasMany
    {
        return $this->hasMany(MataKuliah::class);
    }
}
