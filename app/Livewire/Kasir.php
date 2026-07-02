<?php

namespace App\Livewire;

use App\Models\Categories;
use App\Models\Products;
use App\Models\Transactions;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\DB;

#[Layout('layouts.app')]
#[Title('Kasir - Warung Gorengan')]
class Kasir extends Component
{
    public $search = '';
    public $selectedCategory = '';
    public $cart = [];
    public $categories = [];

    // Checkout state
    public $showCheckoutModal = false;
    public $showCartMobile = false;
    public $totalBayar = 0;
    public $showSuccessModal = false;
    public $lastTransaction = null;

    public function mount()
    {
        $this->categories = Categories::all();
        $this->cart = session()->get('cart', []);
    }

    public function updatedSearch()
    {
        // Realtime search - otomatis trigger render
    }

    public function addToCart($produkId)
    {
        $produk = Products::where('id', $produkId)
            ->where('tersedia', true)
            ->first();

        if (!$produk) {
            $this->dispatch('toast', message: 'Produk tidak tersedia', type: 'error');
            return;
        }

        if (isset($this->cart[$produkId])) {
            if ($this->cart[$produkId]['qty'] >= $produk->stok) {
                $this->dispatch('toast', message: 'Stok tidak mencukupi', type: 'warning');
                return;
            }
            $this->cart[$produkId]['qty']++;
        } else {
            if ($produk->stok <= 0) {
                $this->dispatch('toast', message: 'Stok habis', type: 'error');
                return;
            }
            $this->cart[$produkId] = [
                'id' => $produk->id,
                'nama' => $produk->nama_produk,
                'harga' => (float) $produk->harga_jual,
                'qty' => 1,
                'stok' => $produk->stok,
                'gambar' => $produk->gambar,
            ];
        }

        $this->saveCart();
        $this->dispatch('toast', message: "{$produk->nama_produk} ditambahkan", type: 'success');
    }

    public function updateQty($produkId, $action)
    {
        if (!isset($this->cart[$produkId])) return;

        $produk = Products::find($produkId);

        if ($action === 'increase') {
            if ($this->cart[$produkId]['qty'] >= $produk->stok) {
                $this->dispatch('toast', message: 'Stok tidak mencukupi', type: 'warning');
                return;
            }
            $this->cart[$produkId]['qty']++;
        } elseif ($action === 'decrease') {
            $this->cart[$produkId]['qty']--;
            if ($this->cart[$produkId]['qty'] <= 0) {
                unset($this->cart[$produkId]);
            }
        }

        $this->saveCart();
    }

    public function setQty($id, $qty)
    {
        $qty = max(1, (int) $qty);

        foreach ($this->cart as &$item) {
            if ($item['id'] == $id) {

                // jangan melebihi stok
                if ($qty > $item['stok']) {
                    $qty = $item['stok'];
                }

                $item['qty'] = $qty;
                break;
            }
        }

        $this->calculateTotal();
    }

    public function removeFromCart($produkId)
    {
        if (isset($this->cart[$produkId])) {
            $nama = $this->cart[$produkId]['nama'];
            unset($this->cart[$produkId]);
            $this->saveCart();
            $this->dispatch('toast', message: "{$nama} dihapus", type: 'info');
        }
    }

    public function clearCart()
    {
        $this->cart = [];
        $this->totalBayar = 0;
        $this->saveCart();
        $this->dispatch('toast', message: 'Keranjang dikosongkan', type: 'info');
    }

    public function openCheckout()
    {
        if (empty($this->cart)) {
            $this->dispatch('toast', message: 'Keranjang masih kosong', type: 'warning');
            return;
        }
        $this->totalBayar = $this->calculateTotal();
        $this->showCheckoutModal = true;
    }

    public function closeCheckout()
    {
        $this->showCheckoutModal = false;
        $this->totalBayar = 0;
    }

    public function updatedTotalBayar($value)
    {
        $this->totalBayar = (float) ($value ?? 0);
    }

    public function setQuickPayment($amount)
    {
        $this->totalBayar = $amount;
    }

    public function processCheckout()
    {
        if (empty($this->cart)) {
            $this->dispatch('toast', message: 'Keranjang kosong', type: 'error');
            return;
        }

        $totalHarga = $this->calculateTotal();
        $totalBayar = (float) $this->totalBayar;

        if ($totalBayar < $totalHarga) {
            $this->dispatch('toast', message: 'Pembayaran kurang!', type: 'error');
            return;
        }

        $kembalian = $totalBayar - $totalHarga;

        try {
            DB::beginTransaction();

            // Generate nomor nota: NOTA-YYYYMMDD-XXXX
            $nomorNota = $this->generateNomorNota();

            // Create transaction
            $transaction = Transactions::create([
                'nomor_nota' => $nomorNota,
                'user_id' => auth()->id(),
                'total_harga' => $totalHarga,
                'total_bayar' => $totalBayar,
                'kembalian' => $kembalian,
            ]);

            // Create transaction details & update stock
            foreach ($this->cart as $item) {
                $subtotal = $item['harga'] * $item['qty'];

                $transaction->details()->create([
                    'product_id' => $item['id'],
                    'jumlah' => $item['qty'],
                    'harga_saat_transaksi' => $item['harga'],
                    'subtotal' => $subtotal,
                ]);

                // Decrement stock
                $product = Products::lockForUpdate()->find($item['id']);

                if ($product->stok < $item['qty']) {
                    throw new \Exception("Stok {$product->nama_produk} tidak mencukupi.");
                }

                $product->decrement('stok', $item['qty']);
            }

            DB::commit();

            // Store last transaction for success modal
            $this->lastTransaction = [
                'nomor_nota' => $transaction->nomor_nota,
                'total_harga' => $transaction->total_harga,
                'total_bayar' => $transaction->total_bayar,
                'kembalian' => $transaction->kembalian,
                'items_count' => collect($this->cart)->sum('qty'),
            ];

            // Reset state
            $this->cart = [];
            $this->totalBayar = 0;
            $this->saveCart();
            $this->showCheckoutModal = false;
            $this->showSuccessModal = true;

            $this->dispatch('toast', message: "Transaksi {$nomorNota} berhasil!", type: 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('toast', message: 'Gagal memproses transaksi: ' . $e->getMessage(), type: 'error');
        }
    }

    public function closeSuccessModal()
    {
        $this->showSuccessModal = false;
        $this->lastTransaction = null;
    }

    public function calculateTotal()
    {
        return collect($this->cart)->sum(fn($item) => $item['harga'] * $item['qty']);
    }

    public function getKembalianProperty()
    {
        $total = $this->calculateTotal();
        return max(0, (float) $this->totalBayar - $total);
    }

    public function getCartCountProperty()
    {
        return collect($this->cart)->sum('qty');
    }

    public function getCartItemsProperty()
    {
        return collect($this->cart)->values();
    }

    public function getFilteredProdukProperty()
    {
        $query = Products::where('tersedia', true);

        if ($this->search) {
            $query->where('nama_produk', 'like', "%{$this->search}%");
        }

        if ($this->selectedCategory) {
            $query->where('category_id', $this->selectedCategory);
        }

        return $query->with('kategori')->paginate(10);
    }

    private function saveCart()
    {
        session()->put('cart', $this->cart);
    }

    private function generateNomorNota()
    {
        $date = now()->format('Ymd');
        $lastTransaction = Transactions::whereDate('created_at', today())
            ->orderBy('id', 'desc')
            ->first();

        $sequence = 1;
        if ($lastTransaction) {
            // Extract sequence from last nomor_nota
            $parts = explode('-', $lastTransaction->nomor_nota);
            $sequence = (int) end($parts) + 1;
        }

        return "NOTA-{$date}-" . str_pad($sequence, 4, '0', STR_PAD_LEFT);
    }

    public function render()
    {
        return view('livewire.kasir.kasir', [
            'produkList' => $this->filteredProduk,
            'cartItems' => $this->cartItems,
            'cartCount' => $this->cartCount,
            'total' => $this->calculateTotal(),
            'kembalian' => $this->kembalian,
        ]);
    }
}
