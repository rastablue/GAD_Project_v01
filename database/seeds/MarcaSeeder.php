<?php

use Illuminate\Database\Seeder;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Marca::create([
            'marca' => 'CAT'
        ]);

        App\Marca::create([
            'marca' => 'KOMATSU'
        ]);

        App\Marca::create([
            'marca' => 'TEREX'
        ]);

        App\Marca::create([
            'marca' => 'VOLVO'
        ]);

        App\Marca::create([
            'marca' => 'HITACHI'
        ]);

        App\Marca::create([
            'marca' => 'JOHN DEERE'
        ]);

        App\Marca::create([
            'marca' => 'SANY'
        ]);

        App\Marca::create([
            'marca' => 'ZOOMLION'
        ]);

        App\Marca::create([
            'marca' => 'SANDVIK'
        ]);

        App\Marca::create([
            'marca' => 'LIEBHERR'
        ]);

    }
}
