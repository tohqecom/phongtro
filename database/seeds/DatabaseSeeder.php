<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            'name' => 'Jędrzej Skrodzki',
            'email' => 'jedrzej.skrodzki@gmail.com',
            'password' => bcrypt('qwerty'),
            'admin' => true,
        ]);

        \DB::table('users')->insert([
            'name' => 'Patryk Wiśniewski',
            'email' => 'test@gmail.com',
            'password' => bcrypt('test'),
            'admin' => false,
        ]);

        $car = \App\Car::create([
            'brand' => 'Saab',
            'model' => '93-II',
            'productionYear' => 2006,
            'cost' => 42,
            'available' => true,
        ]);
        \App\CarDetails::create([
            'car_id' => $car->id,
            'gearbox' => 'Manual',
            'fuel_consumption' => 8.2,
            'engine_capacity' => 1920,
            'engine_power' => 120,
            'fuel' => 'Diesel',
            'seats' => 5,
        ]);

        $car = \App\Car::create([
        'brand' => 'Audi',
        'model' => 'A4',
        'productionYear' => 2008,
        'cost' => 54,
        'available' => true,
    ]);
        \App\CarDetails::create([
            'car_id' => $car->id,
            'gearbox' => 'Automatic',
            'fuel_consumption' => 9.4,
            'engine_capacity' => 1968,
            'engine_power' => 143,
            'fuel' => 'Diesel',
            'seats' => 5,
        ]);

        $car = \App\Car::create([
            'brand' => 'Ford',
            'model' => 'Focus',
            'productionYear' => 2003,
            'cost' => 30,
            'available' => true,
        ]);
        \App\CarDetails::create([
            'car_id' => $car->id,
            'gearbox' => 'Manual',
            'fuel_consumption' => 5.6,
            'engine_capacity' => 1753,
            'engine_power' => 100,
            'fuel' => 'Diesel',
            'seats' => 5,
        ]);



    }
}
