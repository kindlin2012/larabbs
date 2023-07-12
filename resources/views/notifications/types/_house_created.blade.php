<li class="d-flex @if ( ! $loop->last) border-bottom @endif">
  <div>
    <a href="{{ route('users.show', $notification->data['user_id']) }}">
      <img class="img-thumbnail mr-3" alt="{{ $notification->data['user_name'] }}" src="{{ $notification->data['user_avatar'] }}" style="width:48px;height:48px;" />
    </a>
  </div>

  <div class="flex-grow-1 ms-2">
    <div class="mt-0 mb-1 text-secondary">
      <a class="text-decoration-none" href="{{ route('users.show', $notification->data['user_id']) }}">{{ $notification->data['user_name'] }}</a>
      创建了
      <a class="text-decoration-none" href="{{ $notification->data['house_link'] }}">{{ $notification->data['house_name'] }}</a>
      {{-- <a class="text-decoration-none" href=#>{{ $notification->data['house_name'] }}</a> --}}
      {{-- 回复删除按钮 --}}
      <span class="meta float-end" title="{{ $notification->created_at }}">
        <i class="far fa-clock"></i>
        {{ $notification->created_at->diffForHumans() }}
      </span>
    </div>
    <div class="reply-content">
      {!! $notification->data['house_description'] !!}
    </div>
  </div>
</li>
