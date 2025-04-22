<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Illuminate\Support\Str;

class BukuController extends Controller
{
    public function index()
    {
        $books = Buku::all();
        return view('buku.index', compact('books'));
    }

    public function create()
    {
        return view('buku.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'nullable|string|max:255',
            'tahun_terbit' => 'nullable|digits:4',
            'isbn' => 'nullable|string|max:20|unique:buku,isbn',
            'stok' => 'required|integer|min:0',
            'sinopsis' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle file upload jika ada
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/buku', $filename);
            $validated['foto'] = 'buku/' . $filename;
        }

        // Simpan data buku
        $buku = new Buku($validated);
        $buku->status = 'tersedia';
        $buku->save();

        // Pastikan folder qrcodes ada
        if (!Storage::disk('public')->exists('qrcodes')) {
            Storage::disk('public')->makeDirectory('qrcodes');
        }

        // Generate QR Code URL
        $borrowingUrl = url('/peminjaman/create?buku_id=' . $buku->id);
        
        // Buat QR Code menggunakan Endroid QR Code
        $qrCode = QrCode::create($borrowingUrl)
            ->setEncoding(new Encoding('UTF-8'))
            ->setSize(300)
            ->setMargin(10)
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

        // Simpan QR Code dalam format PNG
        $qrCodeWriter = new PngWriter();
        $qrCodeResult = $qrCodeWriter->write($qrCode);

        // Simpan ke storage/public/qrcodes/
        $qrCodeName = 'qr_' . $buku->id . '_' . Str::slug($buku->judul) . '.png';
        Storage::disk('public')->put('qrcodes/' . $qrCodeName, $qrCodeResult->getString());

        // Simpan path QR Code ke database
        $buku->qr_code = 'qrcodes/' . $qrCodeName;
        $buku->save();

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil ditambahkan dengan QR Code');
    }
public function scanner()
{
    return view('buku.scan');
}
    public function show($id)
    {
        $buku = Buku::findOrFail($id);
        return view('buku.show', compact('buku'));
    }

    public function scanQR($id)
    {
        $buku = Buku::findOrFail($id);
        if ($buku->stok <= 0) {
            return redirect()->back()->with('error', 'Buku tidak tersedia');
        }
        return redirect()->route('peminjaman.create', ['buku_id' => $buku->id]);
    }

    public function downloadQR($id)
    {
        $buku = Buku::findOrFail($id);

        if (!$buku->qr_code || !Storage::disk('public')->exists($buku->qr_code)) {
            return redirect()->back()->with('error', 'QR Code tidak ditemukan');
        }

        $path = storage_path('app/public/' . $buku->qr_code);
        $fileName = 'qrcode_' . Str::slug($buku->judul) . '.png';

        return response()->download($path, $fileName);
    }
    public function edit($id)
{
    $buku = Buku::findOrFail($id);
    return view('buku.edit', compact('buku'));
}

public function update(Request $request, $id)
{
    $buku = Buku::findOrFail($id);
    
    // Validasi input
    $validated = $request->validate([
        'judul' => 'required|string|max:255',
        'penulis' => 'required|string|max:255',
        'penerbit' => 'nullable|string|max:255',
        'tahun_terbit' => 'nullable|digits:4',
        'isbn' => 'nullable|string|max:20|unique:buku,isbn,' . $id,
        'stok' => 'required|integer|min:0',
        'sinopsis' => 'nullable|string',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Handle file upload jika ada
    if ($request->hasFile('foto')) {
        // Hapus foto lama jika ada
        if ($buku->foto && Storage::disk('public')->exists($buku->foto)) {
            Storage::disk('public')->delete($buku->foto);
        }
        
        $file = $request->file('foto');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/buku', $filename);
        $validated['foto'] = 'buku/' . $filename;
    }

    // Update data buku
    $buku->update($validated);

    return redirect()->route('buku.index')
        ->with('success', 'Buku berhasil diperbarui');
}

public function destroy($id)
{
    $buku = Buku::findOrFail($id);
    
    // Hapus foto jika ada
    if ($buku->foto && Storage::disk('public')->exists($buku->foto)) {
        Storage::disk('public')->delete($buku->foto);
    }
    
    // Hapus QR Code jika ada
    if ($buku->qr_code && Storage::disk('public')->exists($buku->qr_code)) {
        Storage::disk('public')->delete($buku->qr_code);
    }
    
    $buku->delete();

    return redirect()->route('buku.index')
        ->with('success', 'Buku berhasil dihapus');
}
}