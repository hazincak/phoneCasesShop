<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(User::class)->create([
        'first_name' => 'Jan',
        'last_name' => 'Hazincak',
        'street' => '13 Dublin Road',
        'city' => 'Galway',
        'county' => 'Connacht',
        'phone_number' => '+353 080 4912',
        'zip' => '55555',
        'email' => 'jan.hazincak@gmail.com',
        'is_admin' => '1',
        // 'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        ]);

        factory(User::class, 100)->create();
    }
}
