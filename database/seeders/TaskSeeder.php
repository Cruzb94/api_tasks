<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        for ($i=1; $i < 10; $i++) { 
            DB::table('tasks')->insert([
                'name' => 'Tarea '. $i,
                'description' => 'Description tarea '. $i,
                'completed' => 0,
                'user_id' => 1
            ]);
        }
    }
}
