<?php

namespace Tests\Feature;

use Tests\TestCase;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;

class CategoryTest extends TestCase
{
    use MakesGraphQLRequests;

    public function test_can_list_categories()
    {
        $response = $this->graphQL('
            {
                categories {
                    id
                    name
                    products {
                        id
                    }
                }
            }
        ');

        $response->assertStatus(200);
    }

    public function test_can_create_category()
    {
        $response = $this->graphQL('
            mutation {
                createCategory(input: {
                    name: "Test Category"
                }) {
                    id
                    name
                }
            }
        ');

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'createCategory' => [
                        'name' => 'Test Category'
                    ]
                ]
            ]);
    }

    public function test_can_update_category()
    {
        $category = \App\Models\Category::factory()->create();

        $response = $this->graphQL('
            mutation {
                updateCategory(input: {
                    id: ' . $category->id . '
                    name: "Updated Category"
                }) {
                    id
                    name
                }
            }
        ');

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'updateCategory' => [
                        'name' => 'Updated Category'
                    ]
                ]
            ]);
    }
}
