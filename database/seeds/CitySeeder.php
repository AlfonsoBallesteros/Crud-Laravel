<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Cite;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/city.json");
        $data = json_decode($json);
        foreach ($data as $obj) {
            Cite::create(array(
            'id' => $obj->id,
            'name' => $obj->city,
            'state' => $obj->state,
            'department_id' => $obj->department_id
            ));
        }
    }
}
