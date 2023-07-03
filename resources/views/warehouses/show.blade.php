@extends('layouts.app')

@section('content')

<div class="container">
  <div class="col-md-10 offset-md-1">
    <div class="card ">
      <div class="card-header">
        <h1>Warehouse / Show #{{ $warehouse->id }}</h1>
      </div>

      <div class="card-body">
        <div class="card-block bg-light">
          <div class="row">
            <div class="col-md-6">
              <a class="btn btn-link" href="{{ route('warehouses.index') }}"><- Back</a>
            </div>
            <div class="col-md-6">
              <a class="btn btn-sm btn-warning float-right mt-1" href="{{ route('warehouses.edit', $warehouse->id) }}">
                Edit
              </a>
            </div>
          </div>
        </div>
        <br>

        <label>Housename</label>
<p>
	{{ $warehouse->housename }}
</p> <label>User_id</label>
<p>
	{{ $warehouse->user_id }}
</p> <label>Description</label>
<p>
	{{ $warehouse->description }}
</p> <label>Plate_count</label>
<p>
	{{ $warehouse->plate_count }}
</p>
      </div>
    </div>
  </div>
</div>

@endsection
