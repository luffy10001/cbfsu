<x-custom-modal-component>
    <x-slot name="title">
            {{ __('Edit City') }}{{$city->id}}
    </x-slot>
    <x-slot name="body">
        <div class="modal-body">
            <form action="{{route("city.update")}}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$city->id}}">
                <div class="row relative">
                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Name*</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$city->name}}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="province" class="form-label">Province*</label>
                        <select  placeholder="Select a Role" class="form-select" id="province" name="province">
                            <option value="0"> Select a Province</option>
                            @foreach($province as $row)
                                <option value="{{$row->id}}" {{ $row->id== $city->province_id ? 'selected' : '' }}>{{$row->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </x-slot>
</x-custom-modal-component>