<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Siswa extends Model
{
    use HasFactory;

    protected $primaryKey = 'nisn';

    protected $fillable = [
        'nisn', 'nis', 'nama', 'alamat', 'telp',
        'idKelas', 'idSpp',
    ];

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }

    public function bayar(): BelongsTo
    {
        return $this->belongsTo(Spp::class, 'idSpp', 'id');
    }

    public function scopeSearch($query, $search)
    {
        return $query->when($search, function ($query, $find) {
            return $query
                ->where('nama', 'LIKE', $find . '%')
                ->orWhere('nisn', $find)
                ->orWhere('nis', $find);
        });
    }

    public function scopeRender($query, $search)
    {
        return $query
            ->with(['kelas', 'bayar'])
            ->search($search)
            ->paginate(5)
            ->appends([
                'search' => $search,
            ]);
    }
}
