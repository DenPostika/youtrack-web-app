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
                      <li>Estimate : <span class="pull-right">{{ $isueInfo->Estimation / 60 }} ч.</span></li>
                      <li>Потраченое время : <span class="pull-right">{{ $isueInfo->Spent_time / 60 }}ч.</span></li>
                    </ul>
                  </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
