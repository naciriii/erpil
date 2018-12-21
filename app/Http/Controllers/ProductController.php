<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{

    //
    public function index(Request $request)
    {
        // improvised work around to join stock items with products to get quantities
        // lack of resource because of magento rest api
        //$products = $this->send('GET', config('api.products_url'));
        $products = $this->send('GET', str_replace(['{page_size}', '{current_page}'], [$request->page_size, $request->current_page],
            config('api.products_url')
        ));
        $quantities = $this->send('GET', config('api.get_products_quantities'));
        $quantities = collect($quantities->items);
        foreach ($products->items as $product) {
            $product->qty = $quantities->where('product_id', $product->id)->first()->qty ?? null;
        }
        return response()->json($products);
    }

    public function show($sku)
    {
        $data = $this->send('GET', str_replace('{sku}', $sku, config('api.get_product_url')));
        return response()->json($data);
    }

    public function findBy(Request $request)
    {
        $products = $this->send('GET',
            str_replace(
                ['{field}', '{value}', '{page_size}', '{current_page}','{sku_value}'],
                [$request->field, $request->value, $request->page_size, $request->current_page,$request->value],
                config('api.products_by_filter_url')));

        $quantities = $this->send('GET', config('api.get_products_quantities'));
        $quantities = collect($quantities->items);
        foreach ($products->items as $product) {
            $product->qty = $quantities->where('product_id', $product->id)->first()->qty ?? null;
        }

        return response()->json($products);
    }

    public function store(Request $request)
    {
        $data = $this->send('POST', config('api.post_product_url'), $request->product);
        return response()->json($data);
    }

    public function update($sku, Request $request)
    {
        //dd($sku);
        $data = $this->send('PUT', str_replace('{sku}', $sku, config('api.update_product_url')), $request->product);
        return response()->json($data);
    }

    public function delete($sku)
    {
        $data = $this->send("DELETE", str_replace('{sku}', $sku, config('api.delete_product_url')));
        return response()->json($data);
    }

    public function addProductMedia($sku, Request $request)
    {

        $data = $this->send("POST", str_replace('{sku}', $sku, config('api.post_product_media_url')), $request->entry);
        return response()->json($data);
    }

    public function updateProductMedia($sku, Request $request)
    {
        $data = $this->send('PUT', str_replace(['{sku}', '{mediaId}'], [$sku, $request->mediaId], config('api.update_product_media_url')), $request->entry);
        return response()->json($data);
    }
}
