@section('javascript')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.js"></script>
@endsection

<script>
$('#datepicker').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
         });
</script>

@extends('layouts.app')

@section('content')
    <h1>Item Request Form</h1>
    {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('siteId', 'Site Name')}}
            {{Form::select('siteId', $sites, null, ['class' => 'form-control']) }}
        </div>
        
        <div class="form-group">
            {{Form::label('quantity', 'Material')}}
            <select data-live-search="true" id="materialId" name="materialId" data-width="100%" data-live-search-style="startsWith" class="form-control-lg selectpicker">
                @foreach($materialsList as $material)
                    <option value={{$material->id}}>{{$material->MATERIAL_DESCRIPTION}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            {{Form::label('quantity', 'Quantity')}}
            {{Form::text('quantity', '', ['class' => 'form-control', 'placeholder' => 'Quantity'])}}
        </div>

        <div class="form-group">
            {{Form::label('dispatchDate', 'Dispatch Date')}}
            <input type="date" id="dispatchDate" class="form-control" name="dispatchDate">
        </div>

    
    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
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
            </table>
        @else
            <p>You have no posts</p>
        @endif
    </div>
@endsection