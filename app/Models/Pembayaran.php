<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran'; // Menentukan nama tabel secara eksplisit


    protected $fillable = [
        'tanggalBayar', 'jumlah', 'bulanBayar', 'tahunBayar',
        'nisn', 'idUser', 'idSpp',
    ];

    public function siswa(): HasOne
    {
        return $this->hasOne(Siswa::class, 'nisn', 'nisn');
    }

    public function petugas(): HasOne
    {
        return $this->hasOne(User::class, 'id','idUser', );
    }

    public function bayar(): HasOne
    {
        return $this->hasOne(Spp::class, 'id','idSpp');
    }

    public function scopeSearch($query, $search)
    {
        return $query->when($search, function ($query, $find) {
            return $query
                ->where('nisn', $find)
                ->orWhere('bulanBayar', $find)
                ->orWhere('tahunBayar', $find);
        });
    }

    public function scopeRender($query, $search, $key)
    {
        return $query
            ->with(['petugas', 'bayar', 'siswa'])
            ->search($search)
            ->where('nisn', $key)
            ->latest()
            ->paginate(5)
            ->appends([
                'search' => $search,
            ]);
    }
}
