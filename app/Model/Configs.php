<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Configs extends Model
{
    protected $fillable = ['title', 'header_image', 'started_at', 'ended_at','ranking'];
}
