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

class BukuController extends Controller
{
    /**
     * Generate QR code for a book
     */
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
        
        return $result->getDataUri();
    }

    /**
     * Display a listing of books
     */
    public function index()
    {
        $books = Buku::latest()->paginate(10);
        
        // Generate QR codes for each book
        foreach ($books as $book) {
            $book->qr_code = $this->generateQRCode($book);
        }
        
        return view('buku.index', compact('books'));
    }

    /**
     * Show a specific book
     */
    public function show(Buku $buku)
    {
        $buku->qr_code = $this->generateQRCode($buku);
        return view('buku.show', compact('buku'));
    }

    // ... rest of your existing methods (create, store, edit, update, destroy) remain the same
}