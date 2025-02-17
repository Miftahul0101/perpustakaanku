<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class BukuController extends Controller
{
    private function generateQRCode($book)
    {
        $qrCode = new QrCode($book->judul . "\n" . 
                            "Penulis: " . $book->penulis . "\n" .
                            "ISBN: " . $book->isbn);
        
        $qrCode->setSize(300);
        $qrCode->setMargin(10);
        $qrCode->setEncoding(new Encoding('UTF-8'));
        $qrCode->setErrorCorrectionLevel(new ErrorCorrectionLevelHigh);
        $qrCode->setForegroundColor(new Color(0, 0, 0));
        $qrCode->setBackgroundColor(new Color(255, 255, 255));

        $writer = new PngWriter;
        $result = $writer->write($qrCode);
        
        // Save QR code to storage
        $qrPath = 'qrcodes/' . $book->id . '.png';
        Storage::put('public/' . $qrPath, $result->getString());
        
        return [
            'data_uri' => $result->getDataUri(),
            'path' => $qrPath
        ];
    }

    public function index()
    {
        $books = Buku::latest()->paginate(10);
        
        foreach ($books as $book) {
            $qrCode = $this->generateQRCode($book);
            $book->qr_code = $qrCode['data_uri'];
            $book->qr_path = $qrCode['path'];
        }
        
        return view('buku.index', compact('books'));
    }

    public function show(Buku $buku)
    {
        $qrCode = $this->generateQRCode($buku);
        $buku->qr_code = $qrCode['data_uri'];
        $buku->qr_path = $qrCode['path'];
        return view('buku.show', compact('buku'));
    }

    public function create()
    {
        return view('buku.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'penulis' => 'required|max:255',
            'penerbit' => 'nullable|max:255',
            'tahun_terbit' => 'nullable|digits:4',
            'isbn' => 'nullable|unique:buku|max:20',
            'stok' => 'required|integer|min:0',
            'sinopsis' => 'nullable|string', // New validation
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048' // New validation
        ]);

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoPath = $foto->store('public/books');
            $validated['foto'] = str_replace('public/', '', $fotoPath);
        }

        $book = Buku::create($validated);

        // Generate QR code for the new book
        $this->generateQRCode($book);

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(Buku $buku)
    {
        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, Buku $buku)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'penulis' => 'required|max:255',
            'penerbit' => 'nullable|max:255',
            'tahun_terbit' => 'nullable|digits:4',
            'isbn' => 'nullable|unique:buku,isbn,' . $buku->id . '|max:20',
            'stok' => 'required|integer|min:0',
            'sinopsis' => 'nullable|string', // New validation
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048' // New validation
        ]);

        if ($request->hasFile('foto')) {
            // Delete old foto if exists
            if ($buku->foto) {
                Storage::delete('public/' . $buku->foto);
            }
            
            $foto = $request->file('foto');
            $fotoPath = $foto->store('public/books');
            $validated['foto'] = str_replace('public/', '', $fotoPath);
        }

        $buku->update($validated);

        // Regenerate QR code
        $this->generateQRCode($buku);

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Buku $buku)
    {
        // Delete foto and QR code if they exist
        if ($buku->foto) {
            Storage::delete('public/' . $buku->foto);
        }
        Storage::delete('public/qrcodes/' . $buku->id . '.png');

        $buku->delete();

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil dihapus.');
    }

    /**
     * Download QR code for a book
     */
    public function downloadQRCode(Buku $buku)
    {
        $qrCode = $this->generateQRCode($buku);
        $path = storage_path('app/public/' . $qrCode['path']);
        
        return response()->download($path, $buku->judul . '_qr.png');
    }
}