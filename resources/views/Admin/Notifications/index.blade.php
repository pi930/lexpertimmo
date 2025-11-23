@extends('layouts.Admin')

@section('content')
<h2>Notifications</h2>

@foreach($notifications as $notification)
    <div class="card mb-3 {{ $notification->read ? 'bg-light' : 'bg-warning' }}">
        <div class="card-body">
            <p>{{ $notification->content }}</p>

            @if($notification->url)
                <a href="{{ $notification->url }}" class="btn btn-sm btn-primary">Voir le compte</a>
            @endif

            @if(!$notification->read)
                <form action="{{ route('Admin.notifications.read', $notification->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-sm btn-success">Marquer comme lu</button>
                </form>
            @endif
        </div>
    </div>
@endforeach

{{ $notifications->links() }}
@endsection
