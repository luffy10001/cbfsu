<x-custom-modal-component>
    <x-slot name="title">
        {{ __('Assigned Areas & Agencies') }}
    </x-slot>
    <x-slot name="body">
        <div class="modal-body">
            <div class="form-group mb-3">
            Assigned Areas:
                @foreach($areas as $area)
                    <span class="badge bg-secondary">{{$area->name}}</span>
                @endforeach
            </div>
            <div class="form-group mb-3">
                Assigned Agencies:
                @foreach($agencies as $agency)
                    <span class="badge bg-secondary">  {{agencyParam($agency->assigned_agency)}}</span>
                @endforeach
            </div>
            <form action="{{route('users.assign_account_manager')}}" method="POST">
                @csrf
                <input type="hidden" class="form-control" value="{{isset($user->id) ? $user->id: '' }}" id="id" name="id">
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Assign To</label>
                    <select name="manager" class="form-select">
                        <option value="">Select User</option>
                        @foreach($account_managers as $account_manager)
                            <option value="{!! $account_manager->id !!}">{!! userParam($account_manager,$account_manager->role_id) !!}</option>
                        @endforeach
                    </select>
                </div>
                {{--@if(count($account_managers))--}}
                <button type="button" class="form_submit btn btn-primary">Assign & Delete</button>
                    <button type="button" class="btn btn-primary " data-bs-dismiss="modal" aria-label="Close">Cancel
                    </button>
                {{--@else
                    <button type="button" class="form_submit btn btn-primary">Delete</button>
                    <button type="button" class="btn btn-primary " data-bs-dismiss="modal" aria-label="Close">Cancel
                    </button>
                @endif--}}
            </form>
        </div>
    </x-slot>
</x-custom-modal-component>