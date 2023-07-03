@extends('layouts.app')

@section('content')
<div class="container">
  <div class="col-md-10 offset-md-1">
    <div class="card ">
      <div class="card-header">
        <h1>
          Warehouse

          @if (Auth::check() && Auth::user()->id==1)
          <a class="btn btn-success float-xs-right" href="{{ route('warehouses.create') }}">Create</a>
          @endif

        </h1>
      </div>

      <div class="card-body">
        @if($warehouses->count())
          <table class="table table-sm table-striped">
            <thead>
              <tr>
                <th class="text-xs-center">#</th>
                <th>Housename</th> <th>User_id</th> <th>Description</th> <th>Plate_count</th>
                <th class="text-xs-right">OPTIONS</th>
              </tr>
            </thead>

            <tbody>
              @foreach($warehouses as $warehouse)
              <tr>
                <td class="text-xs-center"><strong>{{$warehouse->id}}</strong></td>

                <td>{{$warehouse->housename}}</td> <td>{{$warehouse->user->name}}</td> <td>{{$warehouse->description}}</td> <td>{{$warehouse->plate_count}}</td>

                <td class="text-xs-right">
                  <a class="btn btn-sm btn-primary" href="{{ route('warehouses.show', $warehouse->id) }}">
                    V
                  </a>
                  @can('update', $warehouse)
                  <a class="btn btn-sm btn-warning" href="{{ route('warehouses.edit', $warehouse->id) }}">
                    E
                  </a>

                  <form action="{{ route('warehouses.destroy', $warehouse->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="DELETE">

                    <button type="submit" class="btn btn-sm btn-danger">D </button>
                  </form>
                  @endcan
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {!! $warehouses->render() !!}
        @else
          <h3 class="text-xs-center alert alert-info">Empty!</h3>
        @endif
      </div>
    </div>
  </div>
</div>

@endsection
