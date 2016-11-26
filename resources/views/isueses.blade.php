@extends('layouts.app')
@extends('layouts.sideMenu')

@section('content')
<div class="container"
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Задачи</div>

                <div class="panel-body">
                  <table>
                    <thead>
                      <th>#</th>
                      <th>Заголовок</th>
                    </thead>
                    <tbody>
                     @foreach( $isues as $n => $isue )
                      <tr>
                        <td>{{ $isue->id }}</td>
                        <td><a href="/issue?id={{ $isue->id }}">{{ $isue->summary }}</a></td>
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
