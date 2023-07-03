@extends('layouts.app')

@section('content')

<div class="container">
  <div class="col-md-10 offset-md-1">
    <div class="card ">

      <div class="card-header">
        <h1>
          Warehouse /
          @if($warehouse->id)
            Edit #{{ $warehouse->id }}
          @else
            Create
          @endif
        </h1>
      </div>

      <div class="card-body">
        @if($warehouse->id)
          <form action="{{ route('warehouses.update', $warehouse->id) }}" method="POST" accept-charset="UTF-8">
          <input type="hidden" name="_method" value="PUT">
        @else
          <form action="{{ route('warehouses.store') }}" method="POST" accept-charset="UTF-8">
        @endif

          @include('common.error')

          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          
                <div class="mb-3">
                	<label for="housename-field">Housename</label>
                	<input class="form-control" type="text" name="housename" id="housename-field" value="{{ old('housename', $warehouse->housename ) }}" />
                </div> 
                <div class="mb-3">
                    <label for="user_id-field">User_id</label>
                    <input class="form-control" type="text" name="user_id" id="user_id-field" value="{{ old('user_id', $warehouse->user_id ) }}" />
                </div> 
                <div class="mb-3">
                	<label for="description-field">Description</label>
                	<textarea name="description" id="description-field" class="form-control" rows="3">{{ old('description', $warehouse->description ) }}</textarea>
                </div> 
                <div class="mb-3">
                    <label for="plate_count-field">Plate_count</label>
                    <input class="form-control" type="text" name="plate_count" id="plate_count-field" value="{{ old('plate_count', $warehouse->plate_count ) }}" />
                </div>

          <div class="well well-sm">
            <button type="submit" class="btn btn-primary">Save</button>
            <a class="btn btn-link float-xs-right" href="{{ route('warehouses.index') }}"> <- Back</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
