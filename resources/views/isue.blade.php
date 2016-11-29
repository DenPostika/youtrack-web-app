@extends('layouts.app')
@extends('layouts.sideMenu')

@section('content')
<div class="col-xs-10">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading">Задача</div>
                <div class="panel-body">
                  <div class="title-task col-xs-8">
                    <h2>{{ $isueInfo->summary }}</h2>
                  </div>
                  <div class="box-description col-xs-8">
                    <p>{{ $isueInfo->description}}</p>
                  </div>
                  <div class="box-task col-xs-3">
                    <ul class="box-info">
                      <li>Проект : <span class="pull-right">{{ $isueInfo->projectShortName }}</span></li>
                      <li>Приоритет : <span class="pull-right">{{ $isueInfo->Priority }}</span></li>
                      <li>Тип : <span class="pull-right">{{ $isueInfo->Type }}</span></li>
                      <li>Состояние : <span class="pull-right">{{ $isueInfo->State }}</span></li>
                      <li>Исполнитель : <span class="pull-right">{{ $isueInfo->Assignee }}</span></li>
                      <li>Estimate : <span class="pull-right">{{ floor($isueInfo->Estimation  / 60) }}ч. {{ $isueInfo->Estimation  % 60 }}м.</span></li>
                      <li>Потраченое время : <span class="pull-right">{{ floor($isueInfo->{'Spent time'} / 60) }}ч. {{ $isueInfo->{'Spent time'} % 60 }}м.</span></li>
                    </ul>
                    <div id="slider" class="slider shor slider-material-orange"></div>
                    <input type="button" class="btn btn-info" id="postTimeToServer" value="Перевести">
                    <input hidden id="all_time" value="{{ $user->all_time }}">
                    <input hidden id="token" value="{{ csrf_token() }}">
                    <input hidden id="issue_id" value="{{ $isueInfo->id }}">
                    <span><span id="selected_time">0ч 0м</span> / {{ floor($user->all_time / 60) }}ч {{ $user->all_time % 60 }}м </span>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
