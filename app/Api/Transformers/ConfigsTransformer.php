<?php

namespace App\Api\Transformers;

use App\Model\Configs;
use League\Fractal\TransformerAbstract;

class ConfigsTransformer extends TransformerAbstract
{
    public function transform(Configs $configs)
    {
        return [
            'title' => $configs['title'],
            'header_image' => $configs['header_image'],
            'started_at' => $configs['started_at'],
            'ended_at' => $configs['ended_at'],
            'ranking' => $configs['ranking']
        ];
    }
}