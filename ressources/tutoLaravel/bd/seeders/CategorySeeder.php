<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Etape 1
        DB::table('users')->insert([
             'description' => Str::random(10)
            ]);

        //Etape 2
        //\App\Models\Category::factory(10)->create();
    }
}
