
@extends('layouts.app')


@section('content')
    <h1>Edit Request Order</h1>
    {!! Form::open(['action' => ['PostsController@update', $requestOrder->id], 'class' => 'form-horizontal',
    'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Requested By</label>
            <div class="col-sm-10">
              <input type="text" disabled class="form-control" id="requestedBy" placeholder="Requested By" 
              name="requestedBy" value={{$requestOrder->user->name}}>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Material Code</label>
            <div class="col-sm-10">
              <input type="text" disabled class="form-control" id="materialCode" placeholder="Requester" 
              name="materialCode" value={{$requestOrder->material->id}}>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Material Name</label>
            <div class="col-sm-10">
              <input type="text" disabled class="form-control" id="materialName" placeholder="Requester" 
              name="materialName" value={{$requestOrder->material->MATERIAL_DESCRIPTION}}>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Material Type</label>
            <div class="col-sm-10">
              <input type="text" disabled class="form-control" id="materialType" placeholder="Requester" 
              name="materialType" value={{$requestOrder->material->materialType->type}}>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Unit</label>
            <div class="col-sm-10">
              <input type="text" disabled class="form-control" id="materialType" placeholder="Requester" 
              name="materialType" value={{$requestOrder->material->materialUnit->unit}}>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Requested Date</label>
            <div class="col-sm-10">
              <input type="text" disabled class="form-control" id="requestedDate" placeholder="Requester" 
              name="requestedDate" value={{$requestOrder->Requested_Date}}>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Dispatched Date</label>
            <div class="col-sm-10">
              <input type="text" disabled class="form-control" id="dispatchedDate" placeholder="Dispatched Date" 
              name="dispatchedDate" value={{$requestOrder->Dispatch_Date}}>
            </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="email">Status</label>
          <div class="col-sm-10">
            <select class="browser-default custom-select" id="status" name="status">
              <option value="1">NEW</option>
              <option value="2">RECEIVED</option>
              <option value="3">QA</option>
            </select>
          </div>
      </div>
          <br><br>

        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection