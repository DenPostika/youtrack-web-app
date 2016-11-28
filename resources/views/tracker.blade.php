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
                    <tbody id="time-tbody"></tbody>
                  </table>
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
