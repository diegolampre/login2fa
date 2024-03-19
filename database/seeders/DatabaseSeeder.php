<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Creamos 10 usuarios distintos
     */
    public function run(): void
    {
         //\App\Models\User::factory(1)->create(); //Con este creamos usuario random

         \App\Models\User::factory()->create([  //Definimos usuario que queremos
             'name' => 'pedrito',
             'email' => 'tomaroj758@hdrlog.com',
             'password' => '12345678'
         ]);
    }
}
