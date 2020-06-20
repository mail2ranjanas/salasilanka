
@extends('layouts.app')


@section('content')
    <h1>Request Order Updated Successfully: {{$requestOrder->user->name}} / Site :{{$requestOrder->site->Site_Name}}</h1>
   
    <br><br>  
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
          <label class="control-label col-sm-2" for="email">Order Status</label>
          <div class="col-sm-10">
            <input type="text" disabled class="form-control" id="dispatchedDate" placeholder="Dispatched Date" 
            name="dispatchedDate" value={{$requestOrder->status}}>
          </div>
        </div>
          <br><br>
          <button class="btn btn-primary" onclick="history.go(-1);">Back </button>
          <a href="/display-orders" class="btn btn-primary">Display Orders</a>
        {{-- {{Form::hidden('_method','PUT')}} <!-- change to QQ -->
        @if($requestOrder->Status == "NEW")
          @role('Administrator|Office|QA|Registar')
            {{Form::submit('Update Order to QQ', ['class'=>'btn btn-primary'])}} @endrole
        @endif

        @if($requestOrder->Status == "QQ") <!-- change to PO -->
        @role('Administrator|Office|PO|Registar')
          {{Form::submit('Update Order to PO', ['class'=>'btn btn-primary'])}} @endrole
        @endif

        @if($requestOrder->Status == "PO") <!-- change to Dispatched -->
        @role('Administrator|Office|PO|Registar')
          {{Form::submit('Update Order to PO', ['class'=>'btn btn-primary'])}} @endrole
        @endif

        @if($requestOrder->Status == "RECEIVED") <!-- change to Dispatched -->
        @role('Administrator|Site|SK')
          {{Form::submit('Update Order to PO', ['class'=>'btn btn-primary'])}} @endrole
        @endif
        @if($requestOrder->Status == "DISPATCHED")
        @role('Administrator|Office|PO|Registar')
          {{Form::submit('Update Order to PO', ['class'=>'btn btn-primary'])}} @endrole
        @endif --}}
        
    {!! Form::close() !!}
@endsection