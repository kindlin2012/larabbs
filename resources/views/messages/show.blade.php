@extends('layouts.app')

@section('content')

<div class="container">
  <div class="col-md-10 offset-md-1">
    <div class="card ">
      <div class="card-header">
        <h1>Message / Show #{{ $message->id }}</h1>
      </div>

      <div class="card-body">
        <div class="card-block bg-light">
          <div class="row">
            <div class="col-md-6">
              <a class="btn btn-link" href="{{ route('messages.index') }}"><- Back</a>
            </div>
            <div class="col-md-6">
              <a class="btn btn-sm btn-warning float-right mt-1" href="{{ route('messages.edit', $message->id) }}">
                Edit
              </a>
            </div>
          </div>
        </div>
        <br>

        <label>Sender_id</label>
<p>
	{{ $message->sender_id }}
</p> <label>Receiver_id</label>
<p>
	{{ $message->receiver_id }}
</p> <label>Content</label>
<p>
	{{ $message->content }}
</p>
      </div>
    </div>
  </div>
</div>

@endsection
