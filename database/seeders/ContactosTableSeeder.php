<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('contactos')->insert([
            'nombre' => 'Juan Perez',
            'telefono' => 980765567,
            'email' => 'juan@example.com',
            'direccion' => 'Calle 123'
        ]);
    }
}
