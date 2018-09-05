<?php

namespace App\Api\Controllers;

use App\Api\Transformers\TeamsTransformer;
use App\Model\Team;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    public function index()
    {
        $teams = Team::all();
        return $this->response()->collection($teams, new TeamsTransformer());
    }
}
