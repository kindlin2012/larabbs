@extends('layouts.app')

@section('content')

<div class="container">
  <div class="col-md-10 offset-md-1">
    <div class="card ">

      <div class="card-header">
        <h1>
          私信 /
          @if($message->id)
            Edit #{{ $message->id }}
          @else
            Create
          @endif
        </h1>
      </div>

      <div class="card-body">
        @if($message->id)
          <form action="{{ route('messages.update', $message->id) }}" method="POST" accept-charset="UTF-8">
          <input type="hidden" name="_method" value="PUT">
        @else
          <form action="{{ route('messages.store') }}" method="POST" accept-charset="UTF-8">
        @endif

          @include('common.error')

          <input type="hidden" name="_token" value="{{ csrf_token() }}">


                <div class="mb-3">
                    <label for="sender_id-field">发送者</label>
                    {{-- <input class="form-control" type="text" name="sender_id" id="sender_id-field" value="{{ old('sender_id', $message->sender_id ) }}" /> --}}
                    {{-- <input class="form-control" type="text" name="sender_id" id="sender_id-field" value="{{ \app\Models\User::find($message->sender_id)->name }}" readonly /> --}}
                    {{-- <input class="form-control" type="text" name="sender_id" id="sender_id-field" value="{{ $message->sender->name }}" readonly /> --}}
                    <p class="form-control-static">{{ $message->sender->name }}</p>
                    <input type="hidden" name="sender_id" id="sender_id-field" value="{{ $message->sender_id }}" />
                </div>
                {{-- <div class="mb-3">
                    <label for="receiver_id-field">Receiver_id</label>
                    <input class="form-control" type="text" name="receiver_id" id="receiver_id-field" value="{{ old('receiver_id', $message->receiver_id ) }}" />
                </div> --}}
                <div class="mb-3">
                  <label for="receiver_id-field">接收者</label>
                  @if($message->receiver_id)
                    <p class="form-control-static">{{ $message->receiver->name }}</p>
                    <input type="hidden" name="receiver_id" id="receiver_id-field" value="{{ $message->receiver_id }}" />

                  @else
                    <select class="form-control" name="receiver_id" id="receiver_id-field">
                      @foreach(\App\Models\User::all()->reject(function ($user) use ($message) {
                        return $user->id == $message->sender_id;
                      }) as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                      @endforeach
                    </select>
                  @endif
               </div>
                <div class="mb-3">
                	<label for="content-field">内容</label>
                	<textarea name="content" id="content-field" class="form-control" rows="3">{{ old('content', $message->content ) }}</textarea>
                </div>

          <div class="well well-sm">
            <button type="submit" class="btn btn-primary">发送私信</button>
            <a class="btn btn-link float-xs-right" href="{{ route('messages.index') }}"> <- Back</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
