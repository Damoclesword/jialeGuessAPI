<?php

use Illuminate\Database\Seeder;
use App\Model\Team;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(\Faker\Generator::class);

        $teams = factory(Team::class)->times(18)->make();

        Team::insert($teams->toArray());
    }
}
