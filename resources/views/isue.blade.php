@extends('layouts.app')
@extends('layouts.sideMenu')

@section('content')
<div class="col-xs-10">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading">Задача</div>

                <div class="panel-body">
                  <div class="title-task">
                    <h2>{{ $isueInfo->summary }}</h2>
                  </div>
                  <div class="box-description col-xs-9">
                    <p>{{ $isueInfo->description}}</p>

                  </div>
                  <div class=" box-task col-xs-3">
                    <ul class="box-info">
                      <li>Estimate : <span class="pull-right">{{ $isueInfo->Estimation / 60 }} ч.</span></li>
                      <li>Estimate : {{ $isueInfo->Estimation / 60 }} ч.</li>
                      <li>Estimate : {{ $isueInfo->Estimation / 60 }} ч.</li>
                    </ul>
                  </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
