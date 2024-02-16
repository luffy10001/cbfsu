<x-custom-modal-component>
    <x-slot name="title">
            {{ __('Add Role') }}
    </x-slot>
    <x-slot name="body">
        <div class="modal-body">
            <form action="{{route("roles.store")}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="mb-3">
                    <label for="department_id" class="form-label">Departments</label>
                    <select class="form-control" id="department_id" name="department_id">
                        @foreach($departments as $department)
                            <option value="{{$department->id}}">{{$department->name}} </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </x-slot>
</x-custom-modal-component>

<script>
    $(document).find('#department_id').select2({
        dropdownParent: $('#default_modal'),
    });
</script>