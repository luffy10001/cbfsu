<x-custom-modal-component>
    <x-slot name="title">
        {{ __($user->name." Details") }}
    </x-slot>
    <x-slot name="body">
        <div class="modal-body">
            <form action="{{route('users.assign-area-store',$user->id)}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="role" class="form-label">Select a Area</label>
                    <select multiple class="form-select ccrm-select" id="role" name="area_id" required>
                        @foreach($areas as $area)
                            <option {!! $selfController->mws_user_area($user_areas,$area->id)?'selected':'' !!} value={{$area->id}}>{{$area->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="" class="form_submit btn btn-primary">Save</button>
            </form>
        </div>
    </x-slot>
</x-custom-modal-component>