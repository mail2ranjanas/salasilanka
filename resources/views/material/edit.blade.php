
@extends('layouts.app')


@section('content')
<h1>Edit Meterial - {{$material->MATERIAL_DESCRIPTION}}</h1>
<button class="btn btn-primary" onclick="history.go(-1);">Back </button>
    {!! Form::open(['action' => ['MaterialController@update', $material->id], 'class' => 'form-horizontal',
    'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Material Code</label>
            <div class="col-sm-10">
              <input type="text" disabled class="form-control" id="requestedBy" placeholder="Requested By" 
              name="requestedBy" value={{$material->id}}>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Material Desc</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="materialCode" placeholder="Requester" 
              name="materialCode" value={{$material->MATERIAL_DESCRIPTION}}>
            </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="email">Re Order Qty</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="ReorderQTY" placeholder="Requester" 
            name="ReorderQTY" value={{$material->ReorderQTY}}>
          </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="email">Re Order Qty</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="ReorderQTY" placeholder="Requester" 
          name="ReorderQTY" value={{$material->ReorderQTY}}>
        </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Supply Limit</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="SupplyLimit" placeholder="Requester" 
        name="SupplyLimit" value={{$material->SupplyLimit}}>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="email">REmaterial</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="REmaterial" placeholder="Requester" 
        name="REmaterial" value={{$material->REmaterial}}>
      </div>
  </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="email">CTVprohib</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="CTVprohib" placeholder="Requester" 
        name="CTVprohib" value={{$material->CTVprohib}}>
      </div>
  </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="email">Materials Type</label>
          <div class="col-sm-10">
            <select class="form-control" id="status" name="status">
              @foreach($materialTypes as $materialType)
                   <option <?php if (intval($materialType->id) == intval($material->MATERIAL_TYPE_ID) ) echo 'selected' ; ?> value={{$materialType->id}}>
                    {{$materialType->type}}</option>
              @endforeach
            </select>
          </div>
      </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="email">Materials</label>
          <div class="col-sm-10">
            <select class="form-control" id="status" name="status">
              @foreach($materialUnits as $materialUnit)
                   <option <?php if (intval($materialUnit->id) == intval($material->UNIT_ID) ) echo 'selected' ; ?> value={{$materialUnit->id}}>
                    {{$materialUnit->unit}}</option>
              @endforeach
            </select>
          </div>
      </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Save/Update Material', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection