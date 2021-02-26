<?php

use App\LibroUser;
use Illuminate\Database\Seeder;

class LibroUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(LibroUser::class)->times(50)->create();
    }
}
