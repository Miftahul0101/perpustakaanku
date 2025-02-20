<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DendaPayment extends Model
{
    protected $table = 'denda_payments';
    protected $fillable = [
        'user_id', 'amount', 'payment_date', 'payment_status', 'notes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}