<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = [
            [
                "country_id"=>"2",
                "province_name" => "Province No. 1",
            ],
            [
                "country_id"=>"2",
                "province_name" => "Madhesh Province",
            ],
            [
                "country_id"=>"2",
                "province_name" => "Bagmati Province",
            ],

            [
                "country_id"=>"2",
                "province_name" => "Gandaki Province",
            ],
            [
                "country_id"=>"2",
                "province_name" => "Lumbini Province",
            ],

            [
                "country_id"=>"2",
                "province_name" => "Karnali Province",
            ],
            [
                "country_id"=>"2",
                "province_name" => "Sudurpaschim Province",
            ],

        ];
        foreach ($provinces as $province) {
            Province::firstOrCreate($province);
        }
    }
}
