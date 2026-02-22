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
            'email' => 'admin@gmail.com',
            'password' => bcrypt('root123'),
            'role' => 'admin',
        ]);

        // Create customer users with manga-fan names
        $mangaFans = [
            'Naruto Fan', 'Goku Lover', 'Luffy Crew', 'Levi Stan',
            'Eren Yeager', 'Tanjiro Kamado', 'Deku Hero', 'Itachi Uchiha',
            'Sailor Moon', 'Edward Elric',
        ];

        $customers = collect();
        foreach ($mangaFans as $fanName) {
            $customers->push(User::factory()->create([
                'name' => $fanName,
                'email' => strtolower(str_replace(' ', '.', $fanName)) . '@pageturner.com',
                'password' => bcrypt('password'),
                'role' => 'customer',
            ]));
        }

        // Create manga categories
        $categories = Category::factory(8)->create();

        // Create 5 manga books per category
        $categories->each(function ($category) {
            Book::factory(5)->create(['category_id' => $category->id]);
        });

        $books = Book::all();

        // Create orders and reviews for each customer
        $customers->each(function ($customer) use ($books) {
            // Create 1-3 orders per customer
            $orders = Order::factory(rand(1, 3))->create([
                'user_id' => $customer->id,
            ]);

            $orders->each(function ($order) use ($books) {
                $selectedBooks = $books->random(rand(1, 3));
                $total = 0;

                foreach ($selectedBooks as $book) {
                    $quantity = rand(1, 3);
                    $total += $quantity * $book->price;

                    OrderItem::create([
                        'order_id' => $order->id,
                        'book_id' => $book->id,
                        'quantity' => $quantity,
                        'unit_price' => $book->price,
                    ]);
                }

                $order->update(['total_amount' => $total]);
            });

            // Manga-themed reviews
            $mangaComments = [
                'This manga had me hooked from the first page!',
                'The art style is absolutely stunning. Highly recommended!',
                'The storyline is deep and emotional. I cried at the end.',
                'Best isekai manga I have read all year!',
                'The fight scenes are drawn so dynamically. Amazing!',
                'Character development is top notch. Love the protagonist!',
                'The world building is incredible. Can\'t wait for volume 2!',
                'A masterpiece of the shonen genre. Must read!',
                'The villain is surprisingly sympathetic. Great writing!',
                'Perfect blend of action and comedy. Loved every chapter!',
            ];

            $booksToReview = $books->random(rand(3, 5));
            foreach ($booksToReview as $book) {
                Review::firstOrCreate(
                    ['user_id' => $customer->id, 'book_id' => $book->id],
                    [
                        'rating' => rand(3, 5),
                        'comment' => fake()->randomElement($mangaComments),
                    ]
                );
            }
        });
    }
}