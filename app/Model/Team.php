<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = "teams";
    protected $fillable = ['team_name'];

    public function guesses()
    {
        return $this->hasMany('App\Model\Guess', 'team_id', 'team_id');
    }
}
