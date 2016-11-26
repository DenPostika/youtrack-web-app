@extends('layouts.app')
@extends('layouts.sideMenu')

@section('content')
<div class="col-xs-10">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading">Задачи по проекту <b>{{ ($isues[0]->projectShortName) ? $isues[0]->projectShortName : '' }}</b></div>

                <div class="panel-body">
                  <table class="table table-striped table-hover">
                    <thead>
                      <th>#</th>
                      <th>Название задачи</th>
                      <th>Тип задачи</th>
                      <th>Приоритет</th>
                      <th>Estimation</th>
                    </thead>
                    <tbody>
                     @foreach( $isues as $n => $isue )
                      <tr>
                        <td>{{ ++$n }}</td>
                        <td><a href="/issue?id={{ $isue->id }}">{{ $isue->summary }}</a></td>
                        <td>{{ $isue->Type }}</td>
                        <td>{{ $isue->Priority }}</td>
                        <td>{{ ($isue->Estimation) ? ($isue->Estimation / 60) . ' ч.' : '?' }}</td>
                      </tr>
                     @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
