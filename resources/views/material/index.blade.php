@extends('layouts.app')

@section('content')
    <h1>Registered Materials</h1>
    @if(count($materials) > 0)
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Material Id</th>
                    <th scope="col">Material Name</th>
                    <th scope="col">Unit</th>
                    <th scope="col">Type</th>
                    <th scope="col">ReorderQTY</th>
                    <th scope="col">SupplyLimit</th>
                    <th scope="col">Key IN</th>
                    <th scope="col">Edit</th>
                </tr>
                </thead>
                <tbody>
                @foreach($materials as $material)
                    <tr>
                        <th scope="row">{{$material->id}}</th>
                        <td>{{$material->MATERIAL_DESCRIPTION}}</td>
                        <td>{{$material->materialUnit->unit}}</td>
                        <td>{{$material->materialType->type}}</td>
                        <td>{{$material->ReorderQTY}}</td>
                        <td>{{$material->SupplyLimit}}</td>
                        <td>{{$material->KEINBY}}</td>
                        <td><a href="/material/{{$material->id}}/edit" class="btn btn-default">Edit</a></td>
                    </tr>
                @endforeach
                {{$materials->links()}}
                </tbody>
            </table>
    @else
      <p>No posts found</p>
    @endif
@endsection