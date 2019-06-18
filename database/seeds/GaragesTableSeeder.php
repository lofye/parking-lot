<?php

use Illuminate\Database\Seeder;

use App\Models\Garage;

class GaragesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $garage = new Garage();
        $garage->name = '187 Queen St, London';
        $garage->spaces_total = 10;
        $garage->spaces_occupied = 0;
        $garage->phone_number = '1.519.860.6197';
        $garage->hourly_rate = 3.0;
        $garage->step_increase = 1.5;
        $garage->save();
    }
}
