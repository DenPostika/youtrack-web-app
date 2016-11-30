@extends('layouts.app')
@extends('layouts.sideMenu')

@section('content')
<div class="col-xs-10">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                  <span class="chart-title">График последней активности</span>
                    <div class="chartContainer col-xs-12 chart-style">
                        <canvas id="chart1" height="40" ></canvas>
                    </div>
                    <div class="chart-title">Всего времени доступно: <b>{{ floor($user->all_time / 60) }}ч {{ $user->all_time % 60 }}м</b></div>
                    <table class="table table-hover">
                      <thead>
                        <th>#</th>
                        <th>Дата</th>
                        <th>Задание</th>
                        <th>Потраченое время</th>
                      </thead>
                      <tbody id="time-tbody"></tbody>
                    </table>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
