<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\State;
use Illuminate\Database\Seeder;

class StatesCitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = json_decode(file_get_contents(realpath(__DIR__ . '/../../storage/cities.json')), true);
        foreach ($states as $state) {
            $tempModel = State::create(['id' => $state['id'], 'name' => trim($state['name'])]);
            City::insert(array_map(function ($city) use ($tempModel, &$insertedSlugs) {
                return ['state_id' => $tempModel->id, 'name' => trim($city)];
            }, $state['cities']));
        }
    }
}
