<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfigRequest;
use App\Model\Configs;
use Illuminate\Http\Request;
use League\Flysystem\Config;

class ConfigsController extends Controller
{
    public function root()
    {
        //默认取第一个配置项
        $config = Configs::first();
        return view('configs.root',compact(['config']));
    }

    public function update(ConfigRequest $request)
    {
        $config = Configs::first();
        $config->update($request->all());
        return redirect()->route('admin.configs.root')->with('message',[
            'status_code' => '1',
            'msg' => '配置文件更新成功'
        ]);
    }
}
