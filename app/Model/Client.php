<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Guess;
class Client extends Model
{
    protected $table = "clients";
    protected $primaryKey = 'client_id';

    public function guesses()
    {
        return $this->hasMany('App\Model\Guess','client_id','client_id');
    }
}
