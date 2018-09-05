@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('messages.message')
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            添加参赛队伍
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="{{route('admin.teams.create')}}" method="POST" accept-charset="UTF-8">
                            {{ csrf_field() }}
                            <div class="input-group">
                                <input type="text" class="form-control" name="team_name" placeholder="填入参赛队伍名">
                                <span class="input-group-btn">
                            <button class="btn btn-success" type="submit">提交</button>
                        </span>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            参赛队伍列表
                        </h3>
                    </div>

                    <!-- Table -->
                    <table class="table">
                        <thead class="teams-table-header">
                        <tr>
                            <th>#</th>
                            <th>队伍名</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody class="teams-table-body">
                        @foreach($teams as $team)
                            <tr>
                                <td>{{$team->team_id}}</td>
                                <td>{{$team->team_name}}</td>
                                <td>
                                    {{--<button type="button" class="btn btn-primary" style="margin-right: 10px;">编辑</button>--}}
                                    <button type="button" name="{{route('admin.teams.delete', $team->team_id)}}"
                                            class="deleteBtn btn btn-danger">删除
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extend_js')
    <script>
        $(".deleteBtn").on('click', function (e) {
            var lock = false; //默认未锁定
            var that = $(this);
            var deleteComfirm = layer.confirm('确定要删除该队伍吗？', {
                btn: ['确定', '取消'] //按钮
            }, function () {
                if (!lock) {
                    lock = true;
                    $.ajax({
                        type: "DELETE",
                        url: $(that).attr('name'),
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        contentType: "application/json;charset=utf-8",
                        async: false,
                        success: function (res) {
                            if (res.status_code == 1) {
                                layer.msg('删除成功', {
                                    time: 1000
                                });
                                $(that).parents('tr').remove();
                            }
                            else
                                layer.msg('删除失败', {
                                    time: 1000
                                });
                        },
                        error: function () {
                            layer.msg('删除失败', {
                                time: 1000
                            });
                        }
                    });
                }
                layer.close(deleteComfirm);
            }, function () {
                layer.close(deleteComfirm);
            });

        });
    </script>
@endsection
