@extends('layouts.app')
@extends('layouts.sideMenu')

@section('content')
<div class="col-xs-9"
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading">Проекты</div>

                <div class="panel-body">
                  <table>
                    <thead>
                      <th>#</th>
                      <th>Название</th>
                    </thead>
                    <tbody>
                     @foreach( $projects as $n => $project )
                      <tr>
                        <td>{{ $n }}</td>
                        <td><a href="/issues?project_name={{ $project->shortName }}">{{ $project->name }}</a></td>
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
