@extends('layouts.app')
@extends('layouts.sideMenu')

@section('content')
<div class="col-xs-10">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading">Трекер</div>
                <div class="panel-body">
                  <div class="col-xs-6 timer">
                    <span id="time">0ч 0м</span>
                    <div class="btn-for-time">
                      <a id="action" class="btn btn-info">Начать</a>
                      <a id="stop"  hidden="true">Стоп</a>
                    </div>
                  </div>
                  <div class="col-xs-6" style="clear: both">
                    <textarea id="what_action" placeholder="Что сейчас делаешь?"></textarea>
                  </div>
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
                        <td>2016-11-12</th>
                        <td>Выложить модуль Таксономии WP</td>
                        <td>2ч 30м</th>
                      </tr>
                      <tr>
                        <td>1</td>
                        <td>2016-11-12</td>
                        <td>Выложить модуль Таксономии WP</td>
                        <td>2ч 30м</td>
                      </tr>
                      <tr>
                        <td>1</td>
                        <td>2016-11-12</td>
                        <td>Выложить модуль Таксономии WP</td>
                        <td>2ч 30м</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
