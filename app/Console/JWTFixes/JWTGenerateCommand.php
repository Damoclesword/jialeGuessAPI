<?php
namespace App\Console\JWTFixes;
class JWTGenerateCommand extends \Tymon\JWTAuth\Commands\JWTGenerateCommand
{
    public function handle()
    {
        $this->fire();
    }
}