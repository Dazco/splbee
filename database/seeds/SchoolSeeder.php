<?php

use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \Illuminate\Support\Facades\DB::table('schools')->insert([
            ['name' => 'Princess Adeja International School Benue'],
            ['name' => 'Deeper life High School Osun State'],
            ['name' => 'Deeper life High School, Bayelsa'],
            ['name' => 'The Ambassadors College, Ota'],
            ['name' => 'Cherryfield College, Abuja'],
            ['name' => 'Mount Olive College'],
            ['name' => 'Bookers High School, Ifo'],
            ['name' => 'Honeyland College, Lagos'],
            ['name' => 'Queensland College, Isolo Lagos'],
            ['name' => 'Cuddly Kids Foundation'],
            ['name' => 'First quiver school, Lagos'],
            ['name' => 'Roisprings Schools Lagos'],
            ['name' => 'Eucharistic heart of Jesus model college , epe'],
            ['name' => 'Nigerian Navy Secondary School, Ogbomoso'],
            ['name' => 'Nigerian Christian Institute, Uyo'],
            ['name' => 'First Class School, Ilesha'],
            ['name' => 'Africa Community School, Asokoro, Abuja'],
            ['name' => 'Africa International College, Logogoma, Abuja'],
        ]);
    }
}
