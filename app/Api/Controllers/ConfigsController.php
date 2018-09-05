<?php

namespace App\Api\Controllers;

use App\Api\Transformers\ConfigsTransformer;
use App\Model\Configs;

class ConfigsController extends Controller
{
    public function show()
    {
        $configs = Configs::find(1);
        if (!$configs) {
            return $this->response()->errorNotFound("Configs Not Found");
        }
        return $this->response()->item($configs, new ConfigsTransformer());
    }
}
