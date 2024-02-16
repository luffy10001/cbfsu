<x-custom-modal-component>
    <x-slot name="title">
            {{ __('Edit Permission') }}
    </x-slot>
    <x-slot name="body">
        <div class="modal-body">
            <form action="{{route("permissions.update")}}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$permission->id}}" id="">
                <div class="mb-3">
                    <label for="route_name" class="form-label">Route Name</label>
                    <input type="text" class="form-control" value="{{$permission->route_name}}" id="route_name" name="route_name">
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" id="role" name="role_id" required>
                        <option value="">Select a role</option>
                        @forelse($roles as $role)
                            <option value={{$role->id}} {{ $permission->role_id == $role->id ? "selected" : ""}}>{{$role->name }}</option>';
                        @empty
                        @endforelse
                    </select>
                </div>
                <div class="mb-3 form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" {{$permission->is_active==1? 'checked' : '' }} id="is_active" name="is_active">
                    <label for="active" class="form-lable">Active/Deative</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </x-slot>
</x-custom-modal-component>