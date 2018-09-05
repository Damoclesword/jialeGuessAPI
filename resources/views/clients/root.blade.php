@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            竞猜人员列表
                        </h3>
                    </div>

                    <!-- Table -->
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>姓名</th>
                            <th>联系方式</th>
                            <th>投票时间</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clients as $client)
                            <tr>
                                <td>{{$client->client_id}}</td>
                                <td>{{$client->client_name}}</td>
                                <td>{{$client->client_phone}}</td>
                                <td>{{$client->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection