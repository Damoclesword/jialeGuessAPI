<?php

namespace App\Http\Controllers;

use App\Model\Client;
use App\Model\Configs;
use App\Model\Guess;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Boolean;

class GuessesController extends Controller
{
    /**
     * 筛选竞猜成功者
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function filter(Request $request)
    {
        $config = Configs::find(1);
        $_ids = $request->all();
        $clients = null;
        foreach ($_ids as $index => $team_id) {
            //关键写法
            $result = Client::whereHas('guesses', function ($query) use ($team_id) {
                $query->where('team_id', '=', $team_id);
            })->get();
            if ($index == 0) {
                $clients = $result;
            } else {
                //集合取交集
                $clients = $clients->intersect($result);
            }
        }
        return response()->json($clients->toJson());
    }

    /**
     * 清空竞猜记录
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy()
    {
        $_guesses = false;
        $_clients = false;
        //打开权限
        Schema::disableForeignKeyConstraints();
        if (Guess::truncate()) {
            $_guesses = true;
            if (Client::truncate()) {
                $_clients = true;
            }
        }
        Schema::enableForeignKeyConstraints();
        if ($_guesses && $_clients) {
            $status_code = 1;
            $msg = "清空竞猜记录成功";
        } else {
            $status_code = 0;
            $msg = "清空竞猜记录失败";
        }
        return response()->json([
            'status_code' => $status_code,
            'msg' => $msg
        ]);
    }
}
