<?php


namespace App\Utils\Invoice;


use App\Models\Invoice;
use App\Utils\Client\ClientUtils;
use App\Utils\Currency\CurrencyUtils;
use Codedge\Fpdf\Fpdf\Fpdf;

class InvoicePdfUtils
{
    public static function createPage(Fpdf $pdf, Invoice $invoice)
    {
        //extracting primary data from invoice object
        $MAXIMUM_POSSIBLE_ROW_COUNT_PER_PAGE = 10;
        $customer = $invoice->customer;
        $invoiceItems = $invoice->invoiceItems;
        $total = InvoiceUtils::calculateTotal($invoice);
        $amountInWords = CurrencyUtils::getIndianCurrency($total);

        $pdf->AddPage();
        //horizantal lines
        $pdf->Line(0, 143.5, 210, 143.5);//->Center line
        $pdf->Line(0, 17.5, 210, 17.5);
        $pdf->Line(130, 103, 210, 103);
        $pdf->Line(0, 108, 210, 108);
        $pdf->Line(130, 113, 210, 113);
        $pdf->Line(130, 118, 210, 118);
        $pdf->Line(130, 123, 210, 123);
        $pdf->Line(0, 141.5, 210, 141.5);

        //vertical lines
        $pdf->Line(15, 38, 15, 98);
        $pdf->Line(77, 38, 77, 98);
        $pdf->Line(100, 38, 100, 98);
        $pdf->Line(115, 38, 115, 98);
        $pdf->Line(130, 38, 130, 141.5);
        $pdf->Line(150, 38, 150, 98);
        $pdf->Line(167.5, 38, 167.5, 98);
        $pdf->Line(185, 38, 185, 118);

        //rectangle containers
        $pdf->Rect(0, 38, 210, 10);
        $pdf->Rect(0, 48, 210, 50);

        //data on invoice
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->cell(60, 5, 'GSTIN : ' . ClientUtils::$clientGstNo, 0, 0, 'L');
        $pdf->SetFont('Arial', 'BU', 10);
        $pdf->cell(90, 5, 'TAX INVOICE', 0, 0, 'C');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->cell(60, 5, 'MOB : ' . ClientUtils::$clientMobileNumber1, 0, 1, 'R');
        $pdf->SetFont('Arial', 'B', 20);
        $pdf->cell(50, 10, '', 0, 0, 'C');
        $pdf->cell(110, 10, ClientUtils::$clientName, 0, 0, 'C');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->cell(50, 5, ClientUtils::$clientMobileNumber2, 0, 1, 'R');
        $pdf->cell(210, 3, '', 0, 1, 'C');
        $pdf->cell(210, 5, ClientUtils::$clientAddressLine1, 0, 1, 'C');

        $pdf->cell(22, 5, 'Invoice No:', 0, 0, 'R');
        $pdf->cell(28, 5, str_pad($invoice->id, 6, '0', STR_PAD_LEFT), 0, 0, 'L');

        $pdf->SetFont('Arial', 'BU', 12);
        $pdf->cell(110, 5, 'Cash/Credit Bill', 0, 0, 'C');

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->cell(20, 5, 'Date : ', 0, 0, 'R');
        $pdf->SetFont('Arial', '', 10);
        $pdf->cell(30, 5, date('d-m-Y', strtotime($invoice->creation_time)), 0, 1, 'L');

        $pdf->SetFont('Arial', 'BU', 10);
        $pdf->cell(30, 5, 'Billing To, ', 0, 0, 'R');

        $pdf->SetFont('Arial', 'B', 13);
        $pdf->cell(150, 5, $customer->name, 0, 1, 'C');

        $pdf->SetFont('Arial', '', 10);
        $pdf->cell(210, 5, $customer->address, 0, 1, 'C');

        $pdf->cell(210, 5, "GSTIN : " . ($customer->gst_no ? $invoice->customer->gst_no : 'NA') .
            " PHONE NO : " . ($customer->phone_no ? $invoice->customer->phone_no : 'NA'), 0, 1, 'C');

        // code for table titles
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->cell(15, 10, "SL NO.", 0, 0, 'C');
        $pdf->cell(62, 10, "PARTICULARS", 0, 0, 'C');
        $pdf->cell(23, 10, "HSN CODE.", 0, 0, 'C');
        $pdf->cell(15, 10, "MRP", 0, 0, 'C');
        $pdf->cell(15, 10, "Qty.", 0, 0, 'C');
        $pdf->cell(20, 10, "RATE", 0, 0, 'C');
        $pdf->cell(17.5, 10, "SGST(%)", 0, 0, 'C');
        $pdf->cell(17.5, 10, "CGST(%)", 0, 0, 'C');
        $pdf->cell(25, 10, "AMOUNT", 0, 1, 'C');

        // code for data inside table
        $slno = (($pdf->PageNo() - 1) * InvoiceUtils::$invoiceItemsPerPageCount) + 1;
        $index = $slno - 1;
        $pageItemCount = 0;
        $subTotal = 0;
        while ($pageItemCount < InvoiceUtils::$invoiceItemsPerPageCount && $index < $invoiceItems->count()) {
            $invoiceItem = $invoiceItems[$index];
            $amount = InvoiceUtils::calculateAmount($invoiceItem);
            $pdf->SetFont('Arial', '', 10);
            $pdf->cell(15, 5, $slno, 0, 0, 'C');
            $pdf->cell(62, 5, $invoiceItem->item->name, 0, 0, 'C');
            $pdf->cell(23, 5, $invoiceItem->item->hsn_code, 0, 0, 'C');
            $pdf->cell(15, 5, $invoiceItem->item->mrp, 0, 0, 'C');
            $pdf->cell(15, 5, $invoiceItem->quantity, 0, 0, 'C');
            $pdf->cell(20, 5, (($invoiceItem->rate == 0) ? 'FREE' : $invoiceItem->rate), 0, 0, 'C');
            $pdf->cell(17.5, 5, $invoiceItem->item->sgst . "%", 0, 0, 'C');
            $pdf->cell(17.5, 5, $invoiceItem->item->cgst . "%", 0, 0, 'C');
            $pdf->cell(25, 5, $amount, 0, 1, 'C');
            $subTotal += $amount;
            $slno++;
            $pageItemCount++;
            $index++;
        }

        $emptyCellHeight = 5 * ($MAXIMUM_POSSIBLE_ROW_COUNT_PER_PAGE - $pageItemCount);
        $pdf->cell(210, $emptyCellHeight, '', 0, 1, 'C');

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->cell(40, 5, "AMOUNT IN WORDS : ", 0, 0, 'R');
        $pdf->cell(95, 5, '', 0, 0, 'R');
        $pdf->cell(50, 5, 'Sub-total : ', 0, 0, 'R');
        $pdf->SetFont('Arial', '', 10);
        $pdf->cell(25, 5, round($subTotal, 2) . "/-", 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 10);

        $pdf->SetFont('Arial','',10);
        $pdf->cell(5,5,'',0,0,'L');
        $pdf->cell(130,5,ucfirst($amountInWords),0,0,'L');
        $pdf->SetFont('Arial','B',10);
        $pdf->cell(50,5,'SGST : ',0,0,'R');
        $pdf->SetFont('Arial','',10);
        $pdf->cell(25,5,InvoiceUtils::calculateTotalSgstAmount($invoice).'/-',0,1,'C');

        $pdf->SetFont('Arial','BU',10);
        $pdf->cell(135,5,"Party's seal :",0,0,'L');
        $pdf->SetFont('Arial','B',10);
        $pdf->cell(50,5,'CGST : ',0,0,'R');
        $pdf->SetFont('Arial','',10);
        $pdf->cell(25,5,InvoiceUtils::calculateTotalCgstAmount($invoice).'/-',0,1,'C');

        $pdf->SetFont('Arial','',10);
        $pdf->cell(135,5,'',0,0,'L');
        $pdf->SetFont('Arial','B',10);
        $pdf->cell(50,5,'IGST : ',0,0,'R');
        $pdf->SetFont('Arial','',10);
        $pdf->cell(25,5,InvoiceUtils::calculateTotalIgstAmount($invoice).'/-',0,1,'C');

        $pdf->SetFont('Arial','',10);
        $pdf->cell(135,5,'',0,0,'L');
        $pdf->SetFont('Arial','B',12);
        $pdf->cell(75,5,'GRAND TOTAL : '.number_format(round($total)).'/-',0,1,'C');

        $pdf->cell(210,15,'',0,1,'L');
        $pdf->SetFont('Arial','',9);
        $pdf->cell(135,3,'*goods once sold cannot be taken back or exchanged',0,0,'L');
        $pdf->SetFont('Arial','B',10);
        $pdf->cell(75,3,'FOR SLR Enterprises',0,0,'C');
    }
}
