<?php

return [

'auth_url' => 'integration/admin/token',
'categories_url' => 'categories',
'products_url' => 'products?searchCriteria',
'get_product_url' => 'products/{sku}',
'post_product_url' => 'products',
'update_product_url' => 'products/{sku}',
'delete_product_url' => 'products/{sku}',
'get_products_quantities' => 'stockItems/lowStock/?scopeId=0&qty=10000000&pageSize=1000000',
'customers_url' => 'customers/search?searchCriteria[page_size]={page_size}&searchCriteria[current_page]={current_page}',

];