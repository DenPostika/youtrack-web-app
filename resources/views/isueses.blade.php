@extends('layouts.app')
@extends('layouts.sideMenu')

@section('content')
<div class="col-xs-10">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                @if(isset($isues))
                  <div class="panel-heading">Задачи по проекту <b>{{ ($isues[0]->projectShortName) ? $isues[0]->projectShortName : '' }}</b></div>
                @else
                  <div class="panel-heading">Что то пошло не так :с</div>
                @endif
                <div class="panel-body">
                  @if(isset($isues))
                  <table class="table table-striped table-hover">
                    <thead>
                      <th class="colunm0">#</th>
                      <th class="colunm1">Название задачи</th>
                      <th class="colunm2">Тип задачи</th>
                      <th class="colunm3">Приоритет</th>
                      <th class="colunm4">Estimation</th>
                    </thead>
                    <tbody>
                     @foreach( $isues as $n => $isue )
                      <tr>
                        <td class="colunm0">{{ ++$n }}</td>
                        <td class="colunm1"><a href="/issue?id={{ $isue->id }}">{{ $isue->summary }}</a></td>
                        <td class="colunm2">{{ $isue->Type }}</td>
                        <td class="colunm3">{{ $isue->Priority }}</td>
                        <td class="colunm4">{{ ($isue->Estimation) ? ($isue->Estimation / 60) . ' ч.' : '?' }}</td>
                      </tr>
                     @endforeach
                    </tbody>
                  </table>
                  @elseif(isset($error))
                  <div class="error-block">
                    <i class="material-icons error-icon">cloud_off</i>
                    <p>Произошла ошибка соединения с сервером Youtrack
                    Проверьте <a href="/settings">настройки</a> соединения</p>
                  </div>
                 @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
