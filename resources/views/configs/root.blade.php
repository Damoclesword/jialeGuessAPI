@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <div class="panel-title">
                            相关参数配置
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="{{route('admin.configs.update')}}" method="POST" accept-charset="UTF-8">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group @if($errors->has('title')) has-error @endif">
                                <label for="configTitle">活动标题</label>
                                <input type="text" class="form-control" name="title" id="configTitle"
                                       placeholder="请输入活动标题" aria-describedby="titleCheck" value="{{$config->title}}">
                                @if($errors->has('title'))
                                    <span id="titleCheck" class="help-block">{{$errors->first('title')}}</span>
                                @endif
                            </div>
                            <div class="form-group @if($errors->has('header_image')) has-error @endif">
                                <label for="configHeaderImage">宣传图</label>
                                <input type="text" class="form-control" name="header_image" id="configHeaderImage"
                                       placeholder="请输入图片链接（自行压缩/cdn）" aria-describedby="imgCheck"
                                       value="{{$config->header_image}}">
                                @if($errors->has('header_image'))
                                    <span id="imgCheck" class="help-block">{{$errors->first('header_image')}}</span>
                                @endif
                            </div>
                            <div class="form-group @if($errors->has('started_at')) has-error @endif">
                                <label for="configStartTime">活动开始时间</label>
                                <input type="text" class="form-control" name="started_at" id="configStartTime"
                                       placeholder="点击选择活动开始时间" aria-describedby="startCheck">
                                @if($errors->has('started_at'))
                                    <span id="startCheck" class="help-block">{{$errors->first('started_at')}}</span>
                                @endif
                            </div>
                            <div class="form-group @if($errors->has('ended_at')) has-error @endif">
                                <label for="configEndTime">活动结束时间</label>
                                <input type="text" class="form-control" name="ended_at" id="configEndTime"
                                       placeholder="点击选择活动结束时间" aria-describedby="endCheck">
                                @if($errors->has('ended_at'))
                                    <span id="endCheck" class="help-block">{{$errors->first('ended_at')}}</span>
                                @endif
                            </div>
                            <div class="form-group @if($errors->has('ranking')) has-error @endif">
                                <label for="configRanking">竞猜名次（开始活动后请不要随意更改）</label>
                                <input type="text" class="form-control" name="ranking" id="configRanking"
                                       placeholder="请输入竞猜前几名(注意必须小于参赛队伍数目)" aria-describedby="rankingCheck"
                                       value="{{$config->ranking}}">
                                @if($errors->has('ranking'))
                                    <span id="rankingCheck" class="help-block">{{$errors->first('ranking')}}</span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">保存配置</button>
                        </form>
                    </div>
                </div>
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <div class="panel-title">
                            清空数据(谨慎操作不可逆)
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4 col-md-offset-2" style="text-align: center">
                                <button type="button" class="btn btn-danger d_Guesses">清空竞猜记录</button>
                            </div>
                            <div class="col-md-4" style="text-align: center">
                                <button type="button" class="btn btn-danger d_Teams" disabled="disabled">清空队伍数据</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extend_js')
    <script src="dist/laydate/laydate.js"></script>
    <script>
        var startTime = laydate.render({
            elem: '#configStartTime',
            type: 'datetime',
            theme: '#5cb85c',
            value: '{{$config->started_at}}',

        });

        var endTime = laydate.render({
            elem: '#configEndTime',
            type: 'datetime',
            theme: '#5cb85c',
            value: '{{$config->ended_at}}'
        })

        $("button.d_Guesses").on('click', function () {
            var lock = false; //默认未锁定
            var deleteComfirm = layer.confirm('确定要清空竞猜记录？（该操作不可逆）', {
                btn: ['确定', '取消'] //按钮
            }, function () {
                if (!lock) {
                    lock = true;
                    $.ajax({
                        type: "DELETE",
                        url: '{{route('admin.guesses.destroy')}}',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        contentType: "application/json;charset=utf-8",
                        async: false,
                        success: function (res) {
                            if (res.status_code == 1) {
                                layer.msg(res.msg, {
                                    time: 2000
                                });
                                $("button.d_Teams").removeAttr('disabled');
                            }
                            else
                                layer.msg(res.msg, {
                                    time: 1500
                                });
                        },
                        error: function () {
                            layer.msg("未知错误，清空失败", {
                                time: 1500
                            });
                        }
                    });
                }
                layer.close(deleteComfirm);
            }, function () {
                layer.close(deleteComfirm);
            });
        })


        $("button.d_Teams").on('click', function () {
            var lock = false; //默认未锁定
            var deleteComfirm = layer.confirm('确定要清空队伍数据？（该操作不可逆）', {
                btn: ['确定', '取消'] //按钮
            }, function () {
                if (!lock) {
                    lock = true;
                    $.ajax({
                        type: "DELETE",
                        url: '{{route('admin.teams.destroy')}}',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        contentType: "application/json;charset=utf-8",
                        async: false,
                        success: function (res) {
                            if (res.status_code == 1) {
                                layer.msg(res.msg, {
                                    time: 2000
                                });
                            }
                            else
                                layer.msg(res.msg, {
                                    time: 1500
                                });
                        },
                        error: function () {
                            layer.msg("未知错误，清空失败", {
                                time: 1500
                            });
                        }
                    });
                }
                layer.close(deleteComfirm);
            }, function () {
                layer.close(deleteComfirm);
            });
        })
    </script>
@endsection