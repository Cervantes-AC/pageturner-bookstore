<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition(): array
    {
        $titles = [
            'The Last Ninja Scroll', 'Dragon Soul Awakening', 'Blade of the Fallen Moon',
            'Spirit Hunter Chronicles', 'The Demon King\'s Heir', 'Samurai Without Honor',
            'Celestial Sword Arts', 'Shadow Guild Rising', 'The Phantom Academy',
            'Reborn in Another World', 'Iron Fist Dojo', 'Tokyo Ghost Protocol',
            'The Alchemist\'s Apprentice', 'Blood Pact Chronicles', 'Yokai Detective Agency',
            'The Sacred Beast Contract', 'Cursed Bloodline', 'Academy of Elemental Arts',
            'The Wandering Swordsman', 'Parallel World Chronicles',
            'Gate of the Thunder God', 'Crimson Wolf Clan', 'The Immortal Ronin',
            'Soul Eater Academy', 'Void Walker Chronicles', 'The Fox Spirit\'s Curse',
            'Rising Dragon Fist', 'Moonlit Katana', 'The Exorcist\'s Path',
            'Mecha Pilot Zero', 'Dungeon Crawler Chronicles', 'The Last Onmyoji',
            'Storm Rider Saga', 'Crystal Palace Wars', 'The Witch\'s Grimoire',
            'Awakened Beast King', 'Fallen Angel Protocol', 'The Hidden Leaf Chronicles',
            'Cyber Samurai Rising', 'Ghost Ship Captain',
            'Twin Star Exorcists', 'The Dragon Emperor\'s Son', 'Neon City Hunters',
            'The Cursed Sword Saint', 'Demon Slayer\'s Path', 'Astral Chain Zero',
            'The Time Traveler\'s Blade', 'Sky Fortress Raiders', 'Elemental Chess Master',
            'The Last Dragon Tamer',
        ];

        return [
            'category_id' => Category::factory(),
            'title' => fake()->unique()->randomElement($titles),
            'author' => fake()->randomElement([
                'Hiroshi Tanaka', 'Yuki Nakamura', 'Kenji Watanabe', 'Sakura Mizuno',
                'Ryu Hayashi', 'Aoi Kimura', 'Daichi Suzuki', 'Hana Yamamoto',
                'Taro Fujiwara', 'Mei Ishikawa',
            ]),
            'isbn' => fake()->unique()->isbn13(),
            'price' => fake()->randomFloat(2, 7.99, 29.99),
            'stock_quantity' => fake()->numberBetween(0, 100),
            'description' => fake()->paragraphs(2, true),
            'cover_image' => null,
        ];
    }
}