@extends('layouts.app')

@section('content')
    <h1>Requested Items</h1>
    @if(count($items) > 0)
        @foreach($items as $item)
            <div class="well">
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="/posts/{{$item->id}}">{{$item->itemName}}</a></h3>
                        <small>Written on {{$item->itemCode}} by {{$item->itemDesc}}</small>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p>No posts found</p>
    @endif
@endsection