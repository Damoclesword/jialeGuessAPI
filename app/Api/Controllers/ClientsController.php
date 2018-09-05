<?php

namespace App\Api\Controllers;

use App\Api\Transformers\ClientsTransformer;
use App\Model\Guess;
use App\Model\Team;
use Illuminate\Http\Request;
use App\Api\Controllers\Controller;
use App\Model\Client;


class ClientsController extends Controller
{
    public function show($id) {
        $client = Client::find($id);
        if(!$client) {
            return $this->response()->errorNotFound("Client Not Found");
        }
        return $this->response()->item($client, new ClientsTransformer());
    }

    public function submit(Request $request)
    {
        $client_name = $request->input('client_name');
        $client_phone = $request->input('client_phone');
        $client_guesses = json_decode(json_encode($request->input('guess')),true);

        $clients = new Client;

        $clients->client_name = $client_name;
        $clients->client_phone = $client_phone;

        if($clients->save()) {
            if (is_array($client_guesses) || is_object($client_guesses)){
                foreach ($client_guesses as $team_id) {
                    $guess = new Guess;
                    $guess->client_id = $clients->client_id;
                    $guess->team_id = $team_id;
                    $guess->save();
                }
            }
        }
        else {
            return $this->response->errorForbidden("请不要重复投票！");
        }
    }

}
