@extends('layouts.app')
@extends('layouts.sideMenu')

@section('content')
<div class="container"
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
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
