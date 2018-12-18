<?php

return [

    'auth_url' => 'integration/admin/token',
    'categories_url' => 'categories',
    'get_category_url' => 'categories/{id}',
    'post_category_url' => 'categories',
    'update_category_url' => 'categories/{id}',
    'delete_category_url' => 'categories/{id}',


    'products_url' => 'products?searchCriteria[page_size]={page_size}&searchCriteria[current_page]={current_page}',


    'get_product_url' => 'products/{sku}',
    'post_product_url' => 'products',
    'update_product_url' => 'products/{sku}',
    'delete_product_url' => 'products/{sku}',
    'get_products_quantities' => 'stockItems/lowStock/?scopeId=0&qty=10000000&pageSize=1000000',
    'post_product_media_url' => 'products/{sku}/media',
    'update_product_media_url' => 'products/{sku}/media/{mediaId}',

    'customers_url' => 'customers/search?searchCriteria[page_size]={page_size}&searchCriteria[current_page]={current_page}',
    'customers_by_filter_url' => 'customers/search?searchCriteria[filter_groups][0][filters][0][field]={field}&searchCriteria[filter_groups][0][filters][0][value]={value}',
    'get_customer_url' => 'customers/{id}',
    'post_customer_url' => 'customers',
    'update_customer_url' => 'customers/{id}',
    'delete_customer_url' => 'customers/{id}'
];