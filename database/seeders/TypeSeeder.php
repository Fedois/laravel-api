<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// model
use App\Models\type;

// helpers
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typesName = [
            'Web',
            'Mobile',
            'Desktop',
            'Backend',
            'Frontend',
            'API',
            'Database',
            'Machine Learning',
            'Artificial Intelligence',
            'IoT',
            'Blockchain',
            'E-commerce',
            'Social Network',
            'Gaming',
            'Education',
            'Healthcare',
            'Finance',
            'Travel',
        ];

        foreach ($typesName as $typeName) {
            Type::create([
                'name' => $typeName,
                'slug' => Str::slug($typeName),
            ]);
        }
    }
}
