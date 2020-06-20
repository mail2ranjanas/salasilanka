@extends('layouts.app')

@section('content')
    <h1>Registered Users</h1>
    @if(count($users) > 0)
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Roles</th>
                    <th scope="col">Sites</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                
                    <tr>
                        <th >{{$user->id}}</th>
                        <td>{{$user->name}}</td>
                        <td>  {!! Form::open(['action' => ['UserController@update', $user->id], 'class' => 'form-horizontal',
                            'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                               <table>
                                @foreach($roles as $role)
                                <tr>
                                    <?php
                            
                                        if ($user->getRoleNames()->contains($role->name)){
                                
                                            ?>
                                            <td class="child">
                                                <input type="checkbox" checked name="roleList[]" value={{$role->name}}>{{$role->name}}
                                            </td>
                                            <?php
                                        }else{
                                            ?>
                                            <td class="child">
                                                <input type="checkbox" name="roleList[]" value={{$role->name}}>{{$role->name}}
                                            </td>
                                            <?php
                                        }
                                        ?>
                                        
                        
                                    
                                </tr>
                                @endforeach
                            </table>
                            
                            {{Form::hidden('_method','PUT')}} 
                            {{Form::submit('Update', ['class'=>'btn btn-primary'])}} </td>
                        </td>
                        <td>
                            
                            {!! Form::open(['action' => ['UserController@update', $user->id], 'class' => 'form-horizontal',
                            'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                               <table>
                                   <tr>
                                <td class="child">
                                     <input type="checkbox" name="Administrator" value="Administrator">Administrator
                                </td>
                                <td class="child">
                                    <input type="checkbox" name="PO" value="PO">PO
                               </td>
                               </tr>
                               <tr>
                                <td class="child">
                                     <input type="checkbox" name="Registar" value="Registar">Registar<br>
                                </td>
                                <td class="child">
                                    <input type="checkbox" name="QA" value="QA">QA
                               </td>
                               </tr>
                               <tr>
                                <td class="child">
                                    <input type="checkbox" name="Administrator" value="SK">SK
                                </td>
                               </tr>
                            </table>
                            
                            {{Form::hidden('_method','PUT')}} 
                            {{Form::submit('Update', ['class'=>'btn btn-primary'])}} </td>
                        <td><a href="/user/{{$user->id}}/edit" class="btn btn-default">Edit</a></td>
                        
                    </tr>{!! Form::close() !!}
                @endforeach
                {{$users->links()}}
                </tbody>
            </table>
    @else
      <p>No posts found</p>
    @endif
@endsection