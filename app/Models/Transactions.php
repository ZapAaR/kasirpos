<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transactions extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $fillable = [
        'nomor_nota',
        'user_id',
        'total_harga',
        'total_bayar',
        'kembalian',
    ];

    protected $casts = [
        'total_harga' => 'float',
        'total_bayar' => 'float',
        'kembalian' => 'float',
        'created_at' => 'datetime',
    ];

    public function details(): HasMany
    {
        return $this->hasMany(Transaction_details::class, 'transaction_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Accessor format rupiah
    public function getTotalHargaFormattedAttribute(): string
    {
        return 'Rp ' . number_format($this->total_harga, 0, ',', '.');
    }

    public function getTotalBayarFormattedAttribute(): string
    {
        return 'Rp ' . number_format($this->total_bayar, 0, ',', '.');
    }

    public function getKembalianFormattedAttribute(): string
    {
        return 'Rp ' . number_format($this->kembalian, 0, ',', '.');
    }
}
