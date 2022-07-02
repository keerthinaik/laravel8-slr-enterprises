<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function invoiceItems() {
        return $this->hasMany(InvoiceItem::class);
    }

    public function customer() {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }
}
