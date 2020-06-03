
@extends('layouts.app')

@section('content')
{!! Form::open(['action' => 'RequestOrderController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

    <div class="form-group">
        <select  id="status" name="status"  onchange="this.form.submit()">
            <option value="0">Status</option>
            <option value="1">NEW</option>
            <option value="2">RECEIVED</option>
            <option value="3">QA</option>
        </select>
    </div>

{{Form::submit('Show', ['class'=>'btn btn-primary'])}}
{!! Form::close() !!}

    <div class="panel-body">
        <h3>Item Requests</h3>
        @if(count($requestedItems) > 0)
            <table class="table table-striped">
                <tr>
                    <th>Requestor</th>
                    <th>Material Code</th>
                    <th>Material Name</th>
                    <th>Unit</th>
                    <th>Type</th>
                    <th>Requested Date</th>
                    <th>Desp. Date</th>
                    <th>Edit Request</th>
                    <th>Delete Request</th>
                </tr>
                @foreach($requestedItems as $itemRequest)
                    <tr>
                        <td>{{$itemRequest->user->name}}</td>
                        <td>{{$itemRequest->material->id}}</td>
                        <td>{{$itemRequest->material->MATERIAL_DESCRIPTION}}</td>
                        <td>{{$itemRequest->material->materialUnit->unit}}</td>
                        <td>{{$itemRequest->material->materialType->type}}</td>
                        <td>{{$itemRequest->Requested_Date}}</td>
                        <td>{{$itemRequest->Dispatch_Date}}</td>
                        <td><a href="/posts/{{$itemRequest->id}}/edit" class="btn btn-default">Edit</a></td>
                        <td>
                            {!!Form::open(['action' => ['PostsController@destroy', $itemRequest->id], 'method' => 'POST'])!!}
                                {{Form::hidden('_method', 'DELETE')}}
                                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                            {!!Form::close()!!}
                        </td>
                    </tr>
                @endforeach
                {{$requestedItems->links()}}
            </table>
        @else
            <p>You have no orders</p>
        @endif
    </div>
@endsection