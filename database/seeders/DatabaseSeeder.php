<?php

namespace Database\Seeders;

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
        \App\Models\SaleInfo::factory(200)->create();
        \App\Models\InvoiceDetail::factory(20)->create();
    }
}
