<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('type_permis')->insert([
            'nomination' => 'A1',
            'cas' => 'Moteurs à vitesse à moins de 50 cm3',
            'age_minimum' => 16,
        ]);

        DB::table('type_permis')->insert([
            'nomination' => 'B',
            'cas' => 'Véhicules poids légers',
            'age_minimum' => 18,
        ]);

        DB::table('type_permis')->insert([
            'nomination' => 'C',
            'cas' => 'Véhicules poids lourds',
            'age_minimum' => 21,
        ]);

        DB::table('type_permis')->insert([
            'nomination' => 'D',
            'cas' => 'Véhicules de transport en commun',
            'age_minimum' => 21,
        ]);

        DB::table('type_permis')->insert([
            'nomination' => 'E',
            'cas' => 'Remorques et semi remorques',
            'age_minimum' => 21,
        ]);

        DB::table('type_permis')->insert([
            'nomination' => 'F',
            'cas' => 'Handicapés physiques',
            'age_minimum' => 16,
        ]);
    }
}
