<?php
namespace App\Api\Transformers;

use App\Model\Team;
use League\Fractal\TransformerAbstract;

class TeamsTransformer extends TransformerAbstract
{
    public function transform(Team $teams)
    {
        return [
            'team_id' => $teams['team_id'],
            'team_name' => $teams['team_name'],
        ];
    }
}