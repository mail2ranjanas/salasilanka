
@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-6 col-md-4"><h4><p>Number of item requests :<h4></div>
    <div class="col-6 col-md-4"><h4><p >{{$reportContents->count()}}<h4></div>
</div>
<div class="row">
    <div class="col-6 col-md-4"><h4><p>QA Completed :<h4></div>
    <div class="col-6 col-md-4"><h4><p >{{$reportContents->count()}}<h4></div>
</div>
<br><br>
<table class="table table-striped">
    <thead>
      <tr>
        
        <th scope="col">Order Id</th>
        <th scope="col">Ordered Site</th>
        <th scope="col">Ordered By</th>
        <th scope="col">Requested Date</th>
        <th scope="col">QA By</th>
        <th scope="col">QA Date</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($reportContents as $content)
        <tr>
            
            <td>{{$content->id}}</td>
            <td>{{$content->site->Site_Name}}</td>
            <td>{{$content->user->name}}</td>
            <td>{{$content->Requested_Date}}</td>
            @if($content->qualityCheckedUser !=null) <td>{{$content->qualityCheckedUser->name}}</td> @else <td></td> @endif
            <td>{{$content->Quality_Checked_Date}}</td>
          </tr>      
        @endforeach
    
    </tbody>
  </table>
@endsection