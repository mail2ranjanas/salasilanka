
@extends('layouts.app')

@section('content')
{!! Form::open(['action' => 'RequestOrderController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

    <div class="form-group">
        <select  id="status" name="status"  onchange="this.form.submit()">
            <option value="0">Status</option>
            <option value="All">All</option>
            <option value="NEW">NEW</option>
            <option value="QQ">QQ</option>
            <option value="PO">PO</option>
            <option value="DISPATCHED">DISPATCHED</option>
            <option value="RECEIVED">RECEIVED</option>

        </select>
    </div>

{{Form::submit('Show', ['class'=>'btn btn-primary'])}}
{!! Form::close() !!}

    <div class="panel-body">
        <h3>Item Requests</h3>
        @if(sizeof($requestedItems) > 0)
            <table class="table table-striped">
                
                <tr>
                    <th>Site</th>
                    <th>Requestor</th>
                    <th>Material Code</th>
                    <th>Material Name</th>
                    <th>Status</th>
                    <th>Unit</th>
                    <th>Type</th>
                    <th>Requested Date</th>
                    <th>Desp. Date</th>
                    <th>Edit Request</th>
                    <th>Delete Request</th>
                </tr>
                @foreach($requestedItems as $itemRequest)
                <?php
                        $classType=null;
                        if ($itemRequest->Status =="NEW") {
                            $classType="danger";
                        }
                        if ($itemRequest->Status =="QQ") {
                            $classType="warning";
                        }
                        if ($itemRequest->Status =="PO") {
                            $classType="active";
                        }
                        if ($itemRequest->Status =="DISPATCHED") {
                            $classType="info";
                        }
                        if ($itemRequest->Status =="RECEIVED") {
                            $classType="success";
                        }
                        
                        ?>
                    <tr  class={{$classType}}>
                        <td>{{$itemRequest->site->Site_Name}}</td>
                        <td>{{$itemRequest->user->name}}</td>
                        <td>{{$itemRequest->material->id}}</td>
                        <td>{{$itemRequest->material->MATERIAL_DESCRIPTION}}</td>
                        <td>{{$itemRequest->Status}}</td>
                        <td>{{$itemRequest->material->materialUnit->unit}}</td>
                        <td>{{$itemRequest->material->materialType->type}}</td>
                        <td>{{$itemRequest->Requested_Date}}</td>
                        <td>{{$itemRequest->Dispatch_Date}}</td>
                        <td><a href="/requestorder/{{$itemRequest->id}}/edit" class="btn btn-primary">Edit</a></td> 
                        <td>
                            {!!Form::open(['action' => ['PostsController@destroy', $itemRequest->id], 'method' => 'POST'])!!}
                                {{Form::hidden('_method', 'DELETE')}}
                                @role('Administrator')
                                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}} @endrole

                            @if($itemRequest->Status == "NEW")
                                    @role('Office|QA|Registar')
                                      {{Form::submit('Quality Checked', ['class'=>'btn btn-primary'])}} @endrole
                            @endif

                                
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