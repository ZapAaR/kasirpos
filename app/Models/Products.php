<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'nama_produk',
        'harga_modal',
        'harga_jual',
        'stok',
        'tersedia',
        'gambar'
    ];

    protected $casts = [
        'harga_modal' => 'float',
        'harga_jual' => 'float',
        'stok' => 'integer',
        'tersedia' => 'boolean',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Categories::class, 'category_id', 'id');
    }

    public function getKeuntunganAttribute()
    {
        return $this->harga_jual - $this->harga_modal;
    }

    public function getMarginAttribute()
    {
        if ($this->harga_modal == 0) {
            return 0;
        }
        return (($this->harga_jual - $this->harga_modal) / $this->harga_modal) * 100;
    }

    public function getHargaModalFormattedAttribute()
    {
        return 'Rp ' . number_format($this->harga_modal, 0, ',', '.');
    }

    public function getHargaJualFormattedAttribute()
    {
        return 'Rp ' . number_format($this->harga_jual, 0, ',', '.');
    }
}
