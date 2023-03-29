<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// models
use App\Models\Project;

// help
use Faker\Generator as Faker;
use illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 20 ; $i++) { 
            
            $title = $faker->unique()->sentence(4);

            Project::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'content' => $faker->paragraph(),
            ]);
        }


    }
}
