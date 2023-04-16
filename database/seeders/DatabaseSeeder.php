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

        $user = User::create([
            'name' => 'Janek',
            'email' => 'jan.madeyski@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$wgV4tX42zfH49VkI.Oiew.5IQyaeeiv3DTlVBq/262eYukS3ByoDm', // password
            'remember_token' => Str::random(10),
        ]);

        Listing::factory(\rand(1, 3))->create([ 'user_id' => $user->id ])
        ->each(function($listing) use ($tags) {
            $listing->tags()->attach($tags->random(2));
        });

        User::factory(10)->create()
            ->each(function($user) use ($tags) {
                Listing::factory(\rand(1, 3))->create([
                    'user_id' => $user->id
                ])->each(function($listing) use ($tags) {
                    $listing->tags()->attach($tags->random(2));
                });
            });
    }
}
