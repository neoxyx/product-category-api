# Product Category API with Laravel and GraphQL

This is a GraphQL API for managing products and categories built with Laravel and Lighthouse.

## Installation

1. Clone the repository:
   ```bash
   git clone [repository-url]
   cd product-category-api
2. Install dependencies:
   ```bash
   composer install
3. Create and configure the .env file:
   ```bash
   cp .env.example .env
4. Generate application key:
   ```bash
   php artisan key:generate
5. Set up your database connection in the .env file.
6. Run migrations and seed the database:
   ```bash
   php artisan migrate --seed
7. Start the development server:
   ```bash
   php artisan serve
8. Usage
   Postman url http://localhost:8000/graphql.
    (Select GraphQL in Body)
9. Example Queries
   List all products with their categories:

    {
        products {
            id
            name
            price
            category {
            name
            }
        }
    }

   List all categories with their products:
 
    {
        categories {
            id
            name
            products {
            id
            name
            price
            }
        }
    }

    Example Mutations
    Create a product:

    mutation {
    createProduct(input: {
        name: "New Product",
        description: "Product description",
        price: 29.99,
        category_id: 1
    }) {
        id
        name
       }
    }

    Update a category:
    mutation {
    updateCategory(input: {
        id: 1,
        name: "Updated Category Name"
    }) {
        id
        name
       }
    }
10. Testing
    ```bash
    php artisan test

The architecture follows Laravel best practices with proper use of Eloquent ORM and Lighthouse directives.
