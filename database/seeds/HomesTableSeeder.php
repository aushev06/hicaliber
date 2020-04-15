<?php

use App\Models\Home;
use Illuminate\Database\Seeder;

class HomesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = __DIR__ . '/data/property-data.csv';
        $file = fopen($path, 'r');
        $i    = 0;
        while (($data = fgetcsv($file, 0, ',')) !== false) {
            if ($i === 0) {
                $i++;
                continue;
            }
            Home::create([
                'name'      => $data[0],
                'price'     => $data[1],
                'bedrooms'  => $data[2],
                'bathrooms' => $data[3],
                'storeys'   => $data[4],
                'garages'   => $data[5],
            ]);

            $i++;
        }
    }
}
