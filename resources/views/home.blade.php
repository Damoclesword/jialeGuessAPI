@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">选择获胜队伍</div>
                    </div>
                    <div class="panel-body">
                        <button type="button" class="btn btn-success btn-block chooseVictorBtn">筛选获胜者</button>
                    </div>
                    <div class="list-group teams-list-group">
                        @if(count($teams) > 0)
                            @foreach($teams as $team)
                                <a href="#" class="list-group-item teams-list-item" name="{{$team->team_name}}"
                                   id="{{$team->team_id}}">
                                    {{$team->team_id}}. {{$team->team_name}}
                                </a>
                            @endforeach
                        @else
                            <li class="list-group-item list-group-item-danger">
                                没有获取到参赛队伍数据，请先添加队伍
                            </li>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">获奖列表</h3>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>姓名</th>
                            <th>联系方式</th>
                            <th>投票时间</th>
                        </tr>
                        </thead>
                        <tbody class="victor-list">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extend_js')
    <script>

        function isSelected(item) {
            if ($(item).hasClass('active'))
                return true;
            else
                return false;
        }

        function changeItemStatus(item) {
            if (isSelected($(item))) {
                $(item).removeClass('active');
            }
            else {
                $(item).addClass('active');
            }
        }

        function getSelectedTeams() {
            var selected = [];
            $(".teams-list-item").each(function () {
                if ($(this).hasClass('active')) {
                    selected.push($(this).attr('id'));
                }
            });
            return selected;
        }

        $(".teams-list-item").on('click', function (e) {
            changeItemStatus($(this));
        })

        $("button.chooseVictorBtn").on('click', function (e) {
            let selected = getSelectedTeams();
            if (selected.length > 0) {
                let loading = layer.load(1, {
                    shade: 0.3
                });
                $.ajax({
                    type: "POST",
                    url: '{{route('admin.guesses.filter')}}',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    contentType: "application/json;charset=utf-8",
                    data: JSON.stringify(selected),
                    async: false,
                    success: function (res) {
                        layer.close(loading);
                        if (res) {
                            let vicList = '';
                            if ((JSON).parse(res).length > 0) {
                                $.each(JSON.parse(res), function (key, client) {
                                    console.log(client);
                                    vicList += "<tr>" +
                                        "<td>" + client.client_id + "</td>" +
                                        "<td>" + client.client_name + "</td>" +
                                        "<td>" + client.client_phone + "</td>" +
                                        "<td>" + client.created_at + "</td>" +
                                        "</tr>";
                                    $(".victor-list").html(vicList);
                                })
                            }
                            else {
                                $(".victor-list").html(vicList);
                                layer.msg('查询无结果', {
                                    time: 1500
                                });
                            }
                        }
                    },
                    error: function () {
                        layer.close(loading);
                        $(".victor-list").html('');
                        layer.msg('服务器内部错误，查询失败', {
                            time: 1500
                        });
                    }
                });
            }
            else {
                layer.msg('请至少选择一支队伍进行筛选', {
                    time: 1500
                });
            }
        })
    </script>
@endsection
