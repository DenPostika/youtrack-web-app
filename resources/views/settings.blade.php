@extends('layouts.app')
@extends('layouts.sideMenu')

@section('content')
<div class="col-xs-10">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading">Настройки</div>

                <div class="panel-body">
                  <form class="form-horizontal form-box col-lg-6 col-lg-offset-3" id="change_user_data" method="POST" action="/settings/save">

                      <div class="form-group">
                        <label for="name" class="control-label">Имя пользователя</label>
                        <div class="">
                          <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="name" class="control-label">E-mail</label>
                        <div class="">
                          <input type="text" class="form-control" name="email" value="{{ $user->email }}">
                        </div>
                      </div>

                      <div class="form-group {{ (isset($error)) ? 'has-error' : '' }}">
                        <label for="name" class="control-label">Youtrack</label>
                        <div class="">
                          <input type="text" class="form-control" name="youtrack_url" value="{{ $user->youtrack_url }}">
                        </div>
                      </div>

                      <div class="form-group {{ (isset($error)) ? 'has-error' : '' }}">
                        <label for="name" class="control-label">Youtrack login</label>
                        <div class="">
                          <input type="text" class="form-control" name="youtrack_email" value="{{ $user->youtrack_email }}">
                        </div>
                      </div>

                      <div class="form-group {{ (isset($error)) ? 'has-error' : '' }}">
                        <label for="name" class="control-label">Youtrack password</label>
                        <div class="">
                          <input type="password" class="form-control" name="youtrack_password" value="{{ $user->youtrack_password }}">
                        </div>
                      </div>

                      <div class="text-align-center">
                        {{ csrf_field() }}
                        <a href="{{ URL::previous() }}" class="btn btn-info step-back">Отменить</a>
                        <input type="submit" name="save_user_data" class="btn btn-raised btn-info" value="Сохранить">
                      </div>

                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
