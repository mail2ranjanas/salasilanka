@extends('layouts.app')

@section('javascript')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.js"></script>
@endsection

@section('content')
    <h1>{{$title}}</h1>
    @if(count($services) > 0)
        <ul class="list-group">
            @foreach($services as $service)
                <li class="list-group-item">{{$service}}</li>
            @endforeach
        </ul>
    @endif

    <select data-live-search="true" data-live-search-style="startsWith" class="selectpicker">
        <option value="4444">4444</option>
        <option value="Fedex">Fedex</option>
        <option value="Elite">Elite</option>
        <option value="Interp">Interp</option>
        <option value="Test">Test</option>
    </select>
@endsection

