<?php

namespace App\Http\Controllers;

use App\Model\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class TeamsController extends Controller
{
    public function root()
    {
        $teams = Team::all();
        return view('teams.root', compact(['teams']));
    }

    public function delete(Request $request, $id)
    {
        $team = Team::where('team_id', $id);
        $result = $team->delete();
        if ($result) {
            return response()->json([
                'status_code' => 1,
                'msg' => '删除成功'
            ]);
        } else {
            return response()->json([
                'status_code' => 0,
                'msg' => '删除失败'
            ]);
        }
    }

    public function create(Request $request, Team $teams)
    {
        $teams->fill($request->all());
        if ($teams->save()) {
            $status_code = 1;
            $msg = "添加队伍成功";
        } else {
            $status_code = 0;
            $msg = "添加队伍失败";
        }
        return redirect()->route('admin.teams.root')
            ->with('message', ['status_code' => $status_code, 'msg' => $msg]);
    }

    public function destroy()
    {
        Schema::disableForeignKeyConstraints();
        if (Team::truncate()) {
            $status_code = 1;
            $msg = "清空队伍数据成功";
        } else {
            $status_code = 0;
            $msg = "清空队伍数据失败";
        }
        Schema::enableForeignKeyConstraints();
        return response()->json([
            'status_code' => $status_code,
            'msg' => $msg
        ]);
    }
}
