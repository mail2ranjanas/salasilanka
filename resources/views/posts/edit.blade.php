
@extends('layouts.app')


@section('content')
    <h1>Edit-Request Order from : {{$requestOrder->user->name}} / Site :{{$requestOrder->site->Site_Name}}</h1>
    <button class="btn btn-primary" onclick="history.go(-1);">Back </button>
    <br><br>  
    {!! Form::open(['action' => ['RequestOrderController@update', $requestOrder->id], 'class' => 'form-horizontal',
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
          <label class="control-label col-sm-2" for="email">Current Status</label>
          <div class="col-sm-10">
            <input type="text" disabled class="form-control" id="dispatchedDate" placeholder="Dispatched Date" 
            name="dispatchedDate" value={{$requestOrder->Status}}>
          </div>
      </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="email">Status</label>
          <div class="col-sm-10">
            <select class="form-control" id="status" name="status">
              @foreach($orderStatus as $key => $value)
                   <option <?php if ($value == $selectedOrder ) 'selected' ; ?> value={{$value}}>
                    {{$value}}</option>
              @endforeach
            </select>
          </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="remarks">Remarks</label>
        <div class="col-sm-10">
        {{-- {{Form::textarea('remarks', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Remarks'])}} --}}
      <textarea class="form-control" id="remarks" name="remarks" rows="8">{{$requestOrder->remarks}}</textarea>
        </div>
      </div>
          <br><br>

        {{Form::hidden('_method','PUT')}} <!-- change to QQ -->
        @if($requestOrder->Status == "NEW")
          @role('Administrator|Office|QA|Registar')
            {{Form::submit('Quality Checked', ['class'=>'btn btn-primary'])}} @endrole
        @endif

        @if($requestOrder->Status == "QQ") <!-- change to PO -->
        @role('Administrator|Office|PO|Registar')
          {{Form::submit('Purchase Order issued', ['class'=>'btn btn-primary'])}} @endrole
        @endif

        @if($requestOrder->Status == "PO") <!-- change to Dispatched -->
        @role('Administrator|Office|PO|Registar')
          {{Form::submit('Dispatched', ['class'=>'btn btn-primary'])}} @endrole
        @endif

        @if($requestOrder->Status == "RECEIVED") <!-- change to Dispatched -->
        @role('Administrator|SITE|SK')
          {{Form::submit('Received', ['class'=>'btn btn-primary'])}} @endrole
        @endif
        @if($requestOrder->Status == "DISPATCHED")
        @role('Administrator|PO|SK|SITE|QA')
          {{Form::submit('Received', ['class'=>'btn btn-primary'])}} @endrole
        @endif
        
    {!! Form::close() !!}
@endsection