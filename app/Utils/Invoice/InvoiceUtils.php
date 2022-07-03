<?php


namespace App\Utils\Invoice;


use App\Models\Invoice;
use App\Models\InvoiceItem;

class InvoiceUtils
{
    public static $invoiceItemsPerPageCount = 10;

    public static function calculateAmount(InvoiceItem $invoiceItem)
    {
        $item = $invoiceItem->item;
        $rate = $invoiceItem->rate;
        $quantity = $invoiceItem->quantity;
        $totalTaxPercent = $item->sgst + $item->cgst + $item->igst;
        $amount = ($rate + (($totalTaxPercent / 100) * $rate)) * $quantity;
        return $amount;
    }

    public static function calculateTotal(Invoice $invoice)
    {
        $total = 0;
        foreach ($invoice->invoiceItems as $invoiceItem) {
            $total = $total + self::calculateAmount($invoiceItem);
        }
        return $total;
    }

    public static function calculateTotalSgstAmount(Invoice $invoice)
    {
        $totalSgstAmount = 0;
        foreach ($invoice->invoiceItems as $invoiceItem) {
            $item = $invoiceItem->item;
            $sgstAmount = ($invoiceItem->rate * ($item->sgst / 100)) * $invoiceItem->quantity;
            $totalSgstAmount = $totalSgstAmount + $sgstAmount;
        }
        return $totalSgstAmount;
    }

    public static function calculateTotalCgstAmount(Invoice $invoice)
    {
        $totalCgstAmount = 0;
        foreach ($invoice->invoiceItems as $invoiceItem) {
            $item = $invoiceItem->item;
            $cgstAmount = ($invoiceItem->rate * ($item->cgst / 100)) * $invoiceItem->quantity;
            $totalCgstAmount = $totalCgstAmount + $cgstAmount;
        }
        return $totalCgstAmount;
    }

    public static function calculateTotalIgstAmount(Invoice $invoice)
    {
        $totalIgstAmount = 0;
        foreach ($invoice->invoiceItems as $invoiceItem) {
            $item = $invoiceItem->item;
            $igstAmount = ($invoiceItem->rate * ($item->igst / 100)) * $invoiceItem->quantity;
            $totalIgstAmount = $totalIgstAmount + $igstAmount;
        }
        return $totalIgstAmount;
    }
}
