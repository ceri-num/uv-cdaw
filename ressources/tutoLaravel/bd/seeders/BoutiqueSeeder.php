<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BoutiqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Etape 1
        DB::table('boutique')->insert([
             'nom' => Str::random(10)
            ]);

        //Etape 2
        //\App\Models\Boutique::factory(10)->create();
    }
}
