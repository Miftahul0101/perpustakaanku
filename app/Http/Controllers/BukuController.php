<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;

class BukuController extends Controller
{
    /**
     * Generate QR code for a book
     */
    private function generateQRCode($book)
    {
        // Generate QR code with book information
        $qrContent = json_encode([
            'id' => $book->id,
            'judul' => $book->judul,
            'isbn' => $book->isbn,
            'penulis' => $book->penulis
        ]);

        // Generate QR code and convert to base64
        $qrCode = QrCode::format('png')
                       ->size(300)
                       ->errorCorrection('H')
                       ->generate($qrContent);
                       
        return base64_encode($qrCode);
    }

    /**
     * Display a listing of books
     */
    public function index()
    {
        $books = Buku::latest()->paginate(10);
        return view('buku.index', compact('books'));
    }

    /**
     * Show form for creating a new book
     */
    public function create()
    {
        return view('buku.create');
    }

    /**
     * Store a newly created book
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'penulis' => 'required|max:255',
            'penerbit' => 'nullable|max:255',
            'tahun_terbit' => 'nullable|digits:4|integer|min:1900|max:'.(date('Y')+1),
            'isbn' => 'nullable|max:20|unique:buku,isbn',
            'stok' => 'required|integer|min:0',
        ]);

        // Create the book first
        $book = Buku::create($validated);

        // Generate and save QR code
        $book->qr_code = $this->generateQRCode($book);
        $book->save();

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    /**
     * Show a specific book
     */
    public function show(Buku $buku)
    {
        return view('buku.show', compact('buku'));
    }

    /**
     * Show form for editing a book
     */
    public function edit(Buku $buku)
    {
        return view('buku.edit', compact('buku'));
    }

    /**
     * Update the specified book
     */
    public function update(Request $request, Buku $buku)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'penulis' => 'required|max:255',
            'penerbit' => 'nullable|max:255',
            'tahun_terbit' => 'nullable|digits:4|integer|min:1900|max:'.(date('Y')+1),
            'isbn' => 'nullable|max:20|unique:buku,isbn,'.$buku->id,
            'stok' => 'required|integer|min:0',
        ]);

        // Update the book
        $buku->update($validated);

        // Regenerate QR code if key information has changed
        if ($buku->isDirty(['judul', 'isbn', 'penulis'])) {
            $buku->qr_code = $this->generateQRCode($buku);
            $buku->save();
        }

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil diperbarui.');
    }

    /**
     * Remove the specified book
     */
    public function destroy(Buku $buku)
    {
        $buku->delete();
        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil dihapus.');
    }
}