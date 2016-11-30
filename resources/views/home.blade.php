@extends('layouts.app')
@extends('layouts.sideMenu')

@section('content')
<div class="col-xs-10">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div class="chartContainer">
                        <canvas id="chart1"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
