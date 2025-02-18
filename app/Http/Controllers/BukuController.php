<?php
namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class BukuController extends Controller
{
    private function generateQRCode($book)
    {
        // Create QR code with book ID for scanning
        $qrCode = new QrCode((string)$book->id);
        
        $qrCode->setSize(300);
        $qrCode->setMargin(10);
        $qrCode->setEncoding(new Encoding('UTF-8'));
        $qrCode->setErrorCorrectionLevel(new ErrorCorrectionLevelHigh);
        $qrCode->setForegroundColor(new Color(0, 0, 0));
        $qrCode->setBackgroundColor(new Color(255, 255, 255));
    
        $writer = new PngWriter;
        $result = $writer->write($qrCode);
        
        // Save QR code to storage
        $qrPath = 'qrcodes/' . $book->id . '_' . Str::slug($book->judul) . '.png';
        Storage::put('public/' . $qrPath, $result->getString());
        
        return [
            'data_uri' => $result->getDataUri(),
            'path' => $qrPath
        ];
    }

    public function index()
    {
        $books = Buku::latest()->paginate(10);
        return view('buku.index', compact('books'));
    }

    public function show(Buku $buku)
    {
        $qrCode = $this->generateQRCode($buku);
        $buku->qr_code = $qrCode['data_uri'];
        $buku->qr_path = $qrCode['path'];
        
        $activePeminjaman = $buku->peminjaman()
            ->where('status', 'dipinjam')
            ->with('user')
            ->get();
            
        return view('buku.show', compact('buku', 'activePeminjaman'));
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
            'sinopsis' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Set initial status based on stock
        $validated['status'] = $validated['stok'] > 0 ? 'tersedia' : 'dipinjam';

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoPath = $foto->store('public/books');
            $validated['foto'] = str_replace('public/', '', $fotoPath);
        }

        $book = Buku::create($validated);

        // Generate QR code for the new book
        $qrCode = $this->generateQRCode($book);
        $book->qr_code = $qrCode['path'];
        $book->save();

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
            'sinopsis' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Update status based on new stock value
        $validated['status'] = $validated['stok'] > 0 ? 'tersedia' : 'dipinjam';

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
        $qrCode = $this->generateQRCode($buku);
        $buku->qr_code = $qrCode['path'];
        $buku->save();

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Buku $buku)
    {
        // Check if book has active loans
        if ($buku->peminjaman()->where('status', 'dipinjam')->exists()) {
            return redirect()->route('buku.index')
                ->with('error', 'Buku tidak dapat dihapus karena masih dalam peminjaman.');
        }

        // Delete foto and QR code if they exist
        if ($buku->foto) {
            Storage::delete('public/' . $buku->foto);
        }
        if ($buku->qr_code) {
            Storage::delete('public/' . $buku->qr_code);
        }

        $buku->delete();

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil dihapus.');
    }

    public function downloadQRCode(Buku $buku)
{
    $qrCode = $this->generateQRCode($buku);
    $path = storage_path('app/public/' . $qrCode['path']);
    
    return response()->download($path, Str::slug($buku->judul) . '_qr.png');
}
}