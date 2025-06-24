<?php

namespace App\GraphQL\Mutations;

use App\Models\Product;

class DeleteProduct
{
    public function __invoke($root, array $args)
    {
        $product = Product::findOrFail($args['id']);
        $product->delete();
        return $product;
    }
}
