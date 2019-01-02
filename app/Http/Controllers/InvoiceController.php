<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $invoices = $this->send('GET',
            str_replace(['{page_size}', '{current_page}'],
                [$request->page_size, $request->current_page],
                config('api.invoices_url')));


        $orders = $this->send('GET',
            str_replace(['{page_size}', '{current_page}'],
                [$request->page_size, $request->current_page],
                config('api.orders_url')));


        $orders = collect($orders->items);

        foreach ($invoices->items as $invoice) {

            $invoice->order = $orders->where('entity_id', $invoice->entity_id);

        }
        return response()->json($invoices);
    }

    /*public function find($id)
    {
        $data = $this->send('GET', str_replace('{id}', $id, config('api.get_order_url')));
        return response()->json($data);
    }*/

    public function show($id)
    {
        $order = $this->send('GET', str_replace('{id}', $id, config('api.get_order_url')));
        $invoice = $this->send('GET', str_replace('{id}', $order->entity_id, config('api.get_invoice_url')));

        $data = [
            'order'=>$order,
            'invoice'=>$invoice
        ];

        return response()->json($data);
    }

    /*public function store(Request $request)
    {
        $data = $this->send('POST', str_replace('{entityId}', $request->entity_id, config('api.post_invoice_url')));
        return response()->json($data);
    }*/
}
