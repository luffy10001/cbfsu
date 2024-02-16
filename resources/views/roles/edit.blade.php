<x-custom-modal-component>
    <x-slot name="title">
            {{ __('Edit Role') }}
    </x-slot>
    <x-slot name="body">
        <div class="modal-body">
            <form action="{{route("roles.update")}}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$role->id}}">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{$role->name}}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </x-slot>
</x-custom-modal-component>