<x-custom-modal-component>
    <x-slot name="title">
            {{ __('Edit Department') }}
    </x-slot>
    <x-slot name="body">
        <div class="modal-body">
            <form action="{{route("departments.update")}}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$department->id}}">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{$department->name}}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </x-slot>
</x-custom-modal-component>