<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Book;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class BorrowingController extends Controller
{
    /**
     * Menampilkan daftar transaksi peminjaman.
     */
    public function index()
    {
        if (!Schema::hasTable('borrowings')) {
            $borrowings = collect();
            $needsMigration = true;
            return view('borrowings.index', compact('borrowings', 'needsMigration'));
        }

        $borrowings = Borrowing::with(['member', 'user', 'details.book'])
            ->latest()
            ->get();

        return view('borrowings.index', compact('borrowings'));
    }

    /**
     * Menampilkan form transaksi peminjaman buku baru.
     */
    public function create()
    {
        $members = Schema::hasTable('members') ? Member::orderBy('name')->get() : collect();
        $books   = Schema::hasTable('books') ? Book::orderBy('title')->get() : collect();

        return view('borrowings.create', compact('members', 'books'));
    }

    /**
     * Menyimpan transaksi peminjaman dan mengurangi stok buku.
     */
    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'book_id'   => 'required|exists:books,id',
            'quantity'  => 'required|integer|min:1',
        ], [
            'member_id.required' => 'Anggota wajib dipilih.',
            'member_id.exists'   => 'Anggota yang dipilih tidak valid.',
            'book_id.required'   => 'Buku wajib dipilih.',
            'book_id.exists'     => 'Buku yang dipilih tidak valid.',
            'quantity.required'  => 'Jumlah pinjaman wajib diisi.',
            'quantity.min'       => 'Jumlah pinjaman minimal 1.',
        ]);

        $book = Book::findOrFail($request->book_id);

        // Aturan bisnis: cek ketersediaan stok
        if ($book->stock < $request->quantity) {
            return back()
                ->withErrors([
                    'quantity' => 'Stok buku tidak mencukupi. (Stok tersedia saat ini: ' . $book->stock . ')',
                ])
                ->withInput();
        }

        // Catat transaksi peminjaman
        $borrowing = Borrowing::create([
            'user_id'        => auth()->id(),
            'member_id'      => $request->member_id,
            'borrowing_date' => now()->toDateString(),
            'due_date'       => now()->addDays(7)->toDateString(),
            'status'         => 'borrowed',
        ]);

        // Simpan detail buku yang dipinjam
        $borrowing->details()->create([
            'book_id'  => $book->id,
            'quantity' => $request->quantity,
        ]);

        // Kurangi stok buku
        $book->decrement('stock', $request->quantity);

        return redirect()->route('borrowings.index')
            ->with('success', 'Transaksi peminjaman berhasil dicatat! Stok buku "' . $book->title . '" berkurang ' . $request->quantity . ' eksemplar.');
    }

    /**
     * Memproses pengembalian buku dan mengembalikan stok buku.
     */
    public function returnBook(Borrowing $borrowing)
    {
        if ($borrowing->status === 'returned') {
            return back()->with('error', 'Transaksi ini sudah selesai (buku sudah dikembalikan sebelumnya).');
        }

        $borrowing->update([
            'return_date' => now()->toDateString(),
            'status'      => 'returned',
        ]);

        // Tambah kembali stok setiap buku yang dipinjam
        foreach ($borrowing->details as $detail) {
            $detail->book->increment('stock', $detail->quantity);
        }

        return redirect()->route('borrowings.index')
            ->with('success', 'Buku berhasil dikembalikan! Status transaksi diperbarui dan stok buku telah bertambah kembali.');
    }
}
