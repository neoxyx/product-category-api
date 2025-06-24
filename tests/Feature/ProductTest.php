<?php

namespace Tests\Feature;

use Tests\TestCase;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;

class ProductTest extends TestCase
{
    use MakesGraphQLRequests;

    public function test_can_list_products()
    {
        $response = $this->graphQL('
            {
                products {
                    id
                    name
                    category {
                        name
                    }
                }
            }
        ');

        $response->assertStatus(200);
    }

    public function test_can_create_product()
    {
        $category = \App\Models\Category::factory()->create();

        $response = $this->graphQL('
            mutation {
                createProduct(input: {
                    name: "Test Product",
                    description: "Test Description",
                    price: 19.99,
                    category_id: ' . $category->id . '
                }) {
                    id
                    name
                    price
                }
            }
        ');

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'createProduct' => [
                        'name' => 'Test Product',
                        'price' => 19.99,
                    ]
                ]
            ]);
    }

    public function test_can_update_product()
    {
        $product = \App\Models\Product::factory()->create();

        $response = $this->graphQL('
            mutation {
                updateProduct(input: {
                    id: ' . $product->id . '
                    name: "Updated Product"
                }) {
                    id
                    name
                }
            }
        ');

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'updateProduct' => [
                        'name' => 'Updated Product'
                    ]
                ]
            ]);
    }

    public function test_can_delete_product()
    {
        $product = \App\Models\Product::factory()->create();

        // Verify product exists before deletion
        $this->assertDatabaseHas('products', ['id' => $product->id]);

        $response = $this->graphQL('
        mutation {
            deleteProduct(id: ' . $product->id . ') {
                id
                name
            }
        }
    ');

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'deleteProduct' => [
                        'id' => (string) $product->id,
                        'name' => $product->name
                    ]
                ]
            ]);

        // Verify product no longer exists
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
