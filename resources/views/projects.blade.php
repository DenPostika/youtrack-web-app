@extends('layouts.app')
@extends('layouts.sideMenu')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
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
