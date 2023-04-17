<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagSeeder extends Seeder
{

    const TECHNOLOGY_TREE = [
        'php' => ['laravel', 'symfony'],
        'javascript' => ['vuejs', 'react', 'angular'],
        'go' => ['gin', 'beego', 'iris'],
        'sql' => ['pgsql', 'ERP', 'microsoft sql', 'tsql'],
        'java' => ['spring', 'hibernata', 'struts'],
        'c++'  => ['crow', 'oat++', 'dragon', 'poco'],
        'c#'  => ['asp.net'],
        'ruby' => ['ruby on rails'],
        'pascal' => [],
        'python' => ['AIOHTTP', 'Bottle', 'CherryPy', 'CubicWeb', 'Django', 'Dash', 'Flask'],
        'rust' => ['stdweb','Yew','Percy','Seed','Smithy'],
        'scala' => ['Akka Concurrency Framework', 'Apache Spark', 'Play Framework', 'Scala Slick'],
    ];


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::TECHNOLOGY_TREE as $tech => $stack) {
            Tag::create([ 'name' => $tech, 'slug' => Str::slug($tech) ]);

            foreach ($stack as $name) {
                Tag::create([ 'name' => $name, 'slug' => Str::slug($name) ]);
            }
        }
    }
}
