<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class, 'id', 'invoice_id');
    }

    public function invoice_details()
    {
        return $this->hasMany(InvoiceDetail::class, 'invoice_id', 'id');
    }
}
