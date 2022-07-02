<?php


namespace App\Utils\Invoice;


use App\Models\Invoice;
use App\Models\InvoiceItem;

class InvoiceUtils
{
    public static function calculateAmount(InvoiceItem $invoiceItem)
    {
        $item = $invoiceItem->item;
        $rate = $invoiceItem->rate;
        $quantity = $invoiceItem->quantity;
        $totalTaxPercent = $item->sgst + $item->cgst + $item->igst;
        return $rate + (($totalTaxPercent / 100) * $rate * $quantity);
    }

    public static function calculateTotal(Invoice $invoice)
    {
        $total = 0;
        foreach ($invoice->invoiceItems as $invoiceItem) {
            $total = $total + self::calculateAmount($invoiceItem);
        }
        return $total;
    }
}
