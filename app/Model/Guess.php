<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Client;

class Guess extends Model
{
    protected $table = "guesses";
    protected $fillable = [];

    public function client()
    {
        return $this->belongsTo('App\Model\Client','client_id','client_id,');
    }

    public function team()
    {
        return $this->belongsTo('App\Model\Team','team_id','team_id');
    }
}
