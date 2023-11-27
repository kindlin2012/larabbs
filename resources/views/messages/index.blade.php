@extends('layouts.app')

@section('content')
<div class="container">
  <div class="col-md-10 offset-md-1">
    <div class="card ">
      <div class="card-header">
        <h1>
          Message
          <a class="btn btn-success float-xs-right" href="{{ route('messages.create') }}">Create</a>
        </h1>
      </div>

      <div class="card-body">
        @if($messages->count())
          <table class="table table-sm table-striped">
            <thead>
              <tr>
                <th class="text-xs-center">#</th>
                <th>Sender_id</th> <th>Receiver_id</th> <th>Content</th>
                <th class="text-xs-right">OPTIONS</th>
              </tr>
            </thead>

            <tbody>
              @foreach($messages as $message)
              <tr>
                <td class="text-xs-center"><strong>{{$message->id}}</strong></td>

                <td>{{$message->sender_id}}</td> <td>{{$message->receiver_id}}</td> <td>{{$message->content}}</td>

                <td class="text-xs-right">
                  <a class="btn btn-sm btn-primary" href="{{ route('messages.show', $message->id) }}">
                    V
                  </a>

                  <a class="btn btn-sm btn-warning" href="{{ route('messages.edit', $message->id) }}">
                    E
                  </a>

                  <form action="{{ route('messages.destroy', $message->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="DELETE">

                    <button type="submit" class="btn btn-sm btn-danger">D </button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {!! $messages->render() !!}
        @else
          <h3 class="text-xs-center alert alert-info">Empty!</h3>
        @endif
      </div>
    </div>
  </div>
</div>

@endsection
