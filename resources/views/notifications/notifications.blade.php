<x-custom-modal-component>
    <x-slot name="title">
        {{ __('Notifications') }}
    </x-slot>
    <style>
        .flex-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
    <x-slot name="body">
        <div class="modal-body ">
            @forelse($notifications as $notification)
                <div class="alert alert-success flex-container" role="alert">
                    <div>

                        {{ $notification->created_at->diffForHumans() }} User

                        @foreach ($notification->data as $key => $value)
                            {{ $key }}: {{ $value }}<br>
                        @endforeach
                    </div>
                    <div>
                        @if (!$notification->read_at)
                            <form action="{{ route('notifications.read') }}" method="POST" style="display: inline;">
                                @csrf
                                <input type="hidden" name="notification_id" value="{{ $notification->id }}">
                                <button type="submit" class="float-right mark-as-read" style="bottom: 0px;" >
                                    Mark as read
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                There are no new notifications
            @endforelse
        </div>
    </x-slot>
</x-custom-modal-component>
