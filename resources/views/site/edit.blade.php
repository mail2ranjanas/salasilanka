
@extends('layouts.app')


@section('content')
<h1>Users in  {{$site->Site_Name}} Site</h1>
<button class="btn btn-primary" onclick="history.go(-1);">Back </button>
<br><br>
    {!! Form::open(['action' => ['SiteController@update', $site->id], 'class' => 'form-horizontal',
    'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
<ul class="list-group">
        <div class="form-group">
          
          <div class="col-sm-8">
              @foreach($users as $user)
              
                  <?php
                  if (in_array($user->id, $users_list)){
                                    
                    ?>
                    <li class="list-group-item list-group-item-secondary">
                      <input type="checkbox"checked id="checkItem" name="usersList[]" value={{$user->id}}> {{$user->name}} / {{$user->id}}
                    </li>
                    <?php
                  }else{
                    ?>
                    <li class="list-group-item list-group-item-secondary">
                      <input type="checkbox" id="checkItem" name="usersList[]" value={{$user->id}}> {{$user->name}} / {{$user->id}}
                    </li>
                    <?php
                  }
                  ?>

               @endforeach
          </div>
      </div>
</ul>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Allcate Users to Site', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection