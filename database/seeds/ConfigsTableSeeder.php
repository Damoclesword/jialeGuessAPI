<?php

use Illuminate\Database\Seeder;
use App\Model\Configs;
class ConfigsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $config = new Configs();
        $config->title = "佳乐杯羽毛球赛有奖竞猜";
        $config->save();
    }
}
