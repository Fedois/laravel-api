<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// model
use App\Models\Technology;

// help
use Illuminate\support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologiesName = [
            'PHP',
            'JavaScript',
            'Python',
            'Java',
            'Swift',
            'Kotlin',
            'Ruby',
            'C#',
            'React',
            'Vue.js',
            'Angular',
            'Node.js',
            'Laravel',
            'Symfony',
            'MySQL',
            'PostgreSQL',
            'MongoDB',
            'Redis',
            'Amazon Web Services',
            'Google Cloud Platform',
            'Microsoft Azure',
        ];

        foreach ($technologiesName as $technology) {
            Technology::create([
                'name' => $technology,
                'slug' => Str::slug($technology),
            ]);
        }
    }
}
