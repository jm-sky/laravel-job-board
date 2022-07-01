<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\User;
use App\Models\Listing;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Database\Factories\TagFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $tags = Tag::factory(10)->create();

        User::create([
            'name' => 'Janek',
            'email' => 'jan.madeyski@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$wyxMPSux5yYGfihnDmT4se08Wd/n/DM89qO/7rXOrOKd9ZWVYbmDS', // password
            'remember_token' => Str::random(10),
        ]);

        User::factory(20)->create()
            ->each(function($user) use ($tags) {
                Listing::factory(rand(1, 3))->create([
                    'user_id' => $user->id
                ])->each(function($listing) use ($tags) {
                    $listing->tags()->attach($tags->random(2));
                });
            });

        // \App\Models\Listing::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
