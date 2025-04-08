<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Driver;
use App\Models\Ride;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        Driver::create([
            'name' => 'Али',
            'phone' => '+992900000001',
            'status' => 'available',
        ]);

        Driver::create([
            'name' => 'Мухаммад',
            'phone' => '+992900000002',
            'status' => 'available',
        ]);

        // Добавляем заказы
        Ride::create([
            'customer_name' => 'Али',
            'pickup_location' => 'ТЦ Сиёма',
            'dropoff_location' => 'Аэропорт',
            'status' => 'pending',
        ]);

        Ride::create([
            'customer_name' => 'Мухаммад',
            'pickup_location' => 'Площадь Ленина',
            'dropoff_location' => 'Городская больница',
            'status' => 'pending',
        ]);
    }
}
