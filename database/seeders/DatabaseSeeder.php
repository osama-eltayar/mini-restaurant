<?php

namespace Database\Seeders;

use App\Models\Meal;
use App\Models\Table;
use App\Models\Waiter;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Table::factory(10)->create();
        Meal::factory(10)->create();
        Waiter::factory(5)->create();
    }
}
