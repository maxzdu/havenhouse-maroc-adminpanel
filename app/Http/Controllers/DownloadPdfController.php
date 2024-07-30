<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class DownloadPdfController extends Controller
{
    public function download(client $record)
    {
        $client = new Party([
        ]);

        $customer = new Party([
        ]);

        $items = [
            InvoiceItem::make('')
                ->description('')
                ->pricePerUnit(0)
                ->quantity(0)
                ->discount(0),
        ];

        $notes = [
        ];
        $notes = implode("<br>", $notes);

        $invoice = Invoice::make('')
            ->series('')
            // ability to include translated invoice status
            // in case it was paid
            ->status(__(''))
            ->sequence(0)
            ->serialNumberFormat('')
            ->seller($client)
            ->buyer($customer)
            ->date(now())
            ->dateFormat('')
            ->payUntilDays(0)
            ->currencySymbol('')
            ->currencyCode('')
            ->currencyFormat('')
            ->currencyThousandsSeparator('')
            ->currencyDecimalPoint('')
            ->filename($client->name . '' . $customer->name)
            ->addItems($items)
            ->notes($notes)
            ->logo(public_path('vendor/invoices/sample-logo.png'))
            // You can additionally save generated invoice to configured disk
            ->save('public');

        $link = $invoice->url();
        // Then send email to party with link

        // And return invoice itself to browser or have a different view
        return $invoice->stream();
    }
}
