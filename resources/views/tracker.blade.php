@extends('layouts.app')
@extends('layouts.sideMenu')

@section('content')
<div class="col-xs-10">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading">Трекер</div>
                <div class="panel-body">
                  <span id="time">0ч 20м</span>
                  <a id="action">Начать</a>
                  <a id="stop" hidden="true">Стоп</a>
                  <textarea id="what_action" placeholder="Что сейчас делаешь?"></textarea>
                  <table class="table table-hover">
                    <thead>
                      <th>#</th>
                      <th>Дата</th>
                      <th>Задание</th>
                      <th>Потраченое время</th>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <th>2016-11-12</th>
                        <th>Выложить модуль Таксономии WP</th>
                        <th>2ч 30м</th>
                      </tr>
                      <tr>
                        <td>1</td>
                        <th>2016-11-12</th>
                        <th>Выложить модуль Таксономии WP</th>
                        <th>2ч 30м</th>
                      </tr>
                      <tr>
                        <td>1</td>
                        <th>2016-11-12</th>
                        <th>Выложить модуль Таксономии WP</th>
                        <th>2ч 30м</th>
                      </tr>
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
