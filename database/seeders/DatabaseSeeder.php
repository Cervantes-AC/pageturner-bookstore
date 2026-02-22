<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@pageturner.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Create customer users
        $customers = User::factory(10)->create([
            'role' => 'customer',
            'password' => bcrypt('password'),
        ]);

        // Create categories
        $categories = Category::factory(8)->create();

        // Create 5 books per category
        $categories->each(function ($category) {
            Book::factory(5)->create(['category_id' => $category->id]);
        });

        // Create orders and reviews for each customer
        $books = Book::all();

        $customers->each(function ($customer) use ($books) {
            // Create 1-3 orders per customer
            $orders = Order::factory(rand(1, 3))->create([
                'user_id' => $customer->id,
            ]);

            // Add order items to each order
            $orders->each(function ($order) use ($books) {
                $selectedBooks = $books->random(rand(1, 3));
                $total = 0;

                foreach ($selectedBooks as $book) {
                    $quantity = rand(1, 3);
                    $unitPrice = $book->price;
                    $total += $quantity * $unitPrice;

                    OrderItem::create([
                        'order_id' => $order->id,
                        'book_id' => $book->id,
                        'quantity' => $quantity,
                        'unit_price' => $unitPrice,
                    ]);
                }

                $order->update(['total_amount' => $total]);
            });

            // Each customer reviews 3-5 random books
            $booksToReview = $books->random(rand(3, 5));
            foreach ($booksToReview as $book) {
                // Avoid duplicate reviews (unique constraint)
                Review::firstOrCreate(
                    ['user_id' => $customer->id, 'book_id' => $book->id],
                    [
                        'rating' => rand(1, 5),
                        'comment' => fake()->paragraph(),
                    ]
                );
            }
        });
    }
}