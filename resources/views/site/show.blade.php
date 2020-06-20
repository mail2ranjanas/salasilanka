@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Site Info</h2>
     <table class="table">
      <thead>
        <tr>
          <th>Site Id</th>
          <th>Site Name</th>
          <th>Site Description</th>
          <th>Site Start Date</th>
          <th>Allocate Users</th>
        </tr>
      </thead>
      
      <tbody>
          <?php
          $index = 0;
          ?>
      @foreach($sites as $site)
      <?php
      $index++;
      if($index%2==0)
        $classv="info";
      else
        $classv="success";
      ?>

        <tr class={{$classv}}>
          <td>{{$site->id}}</td>
          <td>{{$site->Site_Name}}</td>
          <td>"{{$site->Site_Desc}}"</td>
          <td>{{$site->created_at}}</td>
          <td><a href="/site/{{$site->id}}/edit" class="btn btn-primary">Allocate/Deallocate</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <a href="/site/create" class="btn btn-primary">Create New Site</a>
  </div>

  
  


@endsection