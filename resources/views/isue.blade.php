@extends('layouts.app')
@extends('layouts.sideMenu')

@section('content')
<div class="col-xs-9">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading">Задача</div>

                <div class="panel-body">
                  <h2>{{ $isueInfo->summary }}</h2>
                  <p>{{ $isueInfo->description}}</p>
                  <p>Estimate : {{ $isueInfo->Estimation / 60 }} ч.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
