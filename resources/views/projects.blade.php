@extends('layouts.app')
@extends('layouts.sideMenu')

@section('content')
<div class="col-xs-10">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading">Проекты</div>

                <div class="panel-body">
                  @if(isset($projects))
                  <table class="table table-striped table-hover">
                    <thead>
                      <th class="colunm0">#</th>
                      <th class="colunm1">Название проекта</th>
                    </thead>
                    <tbody>
                     @foreach( $projects as $n => $project )
                      <tr>
                        <td class="colunm0">{{ ++$n }}</td>
                        <td class="colunm1"><a href="/issues?project_name={{ $project->shortName }}">{{ $project->name }}</a></td>
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
