<?php
namespace App\Api\Transformers;

use App\Model\Client;
use League\Fractal\TransformerAbstract;

class ClientsTransformer extends TransformerAbstract
{
    public function transform(Client $clients)
    {
        return [
            'id' => $clients['client_id'],
            'client_name' => $clients['client_name'],
            'client_phone' => $clients['client_phone']
        ];
    }
}