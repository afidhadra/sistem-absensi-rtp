<?php

namespace App\Models;

use Database\Factories\FakultasFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fakultas extends Model
{
    /** @use HasFactory<FakultasFactory> */
    use HasFactory;

    protected $table = 'fakultas';

    /**
     * @return HasMany<ProgramStudi, $this>
     */
    public function programStudi(): HasMany
    {
        return $this->hasMany(ProgramStudi::class);
    }

    /**
     * @return HasMany<Dosen, $this>
     */
    public function dosen(): HasMany
    {
        return $this->hasMany(Dosen::class);
    }
}
