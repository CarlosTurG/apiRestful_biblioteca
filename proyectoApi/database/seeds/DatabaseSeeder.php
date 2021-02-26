<?php


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
        $this->call(UserSeeder::class);
        $this->call(LibroSeeder::class);
        $this->call(LibroUserSeeder::class);

        /*$users = factory(User::class, 30)->create();

        factory(Libro::class, 50)->create()->each( 
                function($libro) use ($user){
                    $randomUsers = $user->random(mt_rand(1,20))->pluck('id');
                    $libro->users()->attach($randomUsers);
                }
            );*/
        }
}
