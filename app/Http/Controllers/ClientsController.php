<?php

namespace App\Http\Controllers;

use App\Model\Client;
use Illuminate\Http\Request;

class ClientsController extends Controller
{

    /**
     * admin functions
     */
    public function root()
    {
        $clients = Client::all();
        return view('clients.root', compact(['clients']));
    }
}
