<x-custom-modal-component>
    <x-slot name="title">
        {{ __('Assign Area To '.$user->name) }}
    </x-slot>

    <x-slot name="body">
        <div class="modal-body">

            <form action="{{route('users.assign-area-store',$user->id)}}" method="POST">
                @csrf
                <div class=" mb-3">
                    <label for="name" class="form-label">City</label>
                    <?php $isflag =is_user_has_agency($user->id)?>
                    <div class="{!! $isflag?'readonly_added':'' !!}">
                        <select target='select[name="area_id"]' placeholder="Select a Area"
                                url="{!! route('getCities.Area') !!}" params="city_id" name="city_id"
                                class="form-select changeInputMws input_city_id cityies_selector">
                            <option value="">Select a city</option>
                            @foreach($city_data as $row)
                                <option value="{{ $row['id'] }}" {{!empty($user->city_id) && $user->city_id == $row['id'] ? 'selected' : '' }}>{{ $row['name'] }}</option>
                            @endforeach
                        </select>
                        {!! $isflag?'<div class="test"></div>':'' !!}
                    </div>

                </div>


                <div class="mb-3">
                    <label for="role" class="form-label">Area</label>
                    <div class="form-check">
                        <input class="form-check-input selectAll "  value="select" type="radio" name="selectAll" id="selectAll">
                        <label class="form-check-label" for="selectAll"> Select All</label>
                    </div>
                    <div class="form-check ">
                        <input class="form-check-input selectAll" value="deselect" type="radio" name="selectAll"  id="deselectAll">
                        <label class="form-check-label" for="deselectAll"> DeSelect All</label>
                    </div>
                    <select {!! ($user->city_id ===null && count($user_areas)===0)?'disabled':'' !!} multiple class="form-select ccrm-selectnew" id="role" name="area_id">
                        @foreach($areas as $key => $area)
                            <option {!! is_area_has_agency($user->id,$area->id)?'class="no-clear-button"':'' !!}  {!! $selfController->mws_user_area($user_areas,$area->id)?'selected':'' !!} value={{$area->id}}>{{$area->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="button" class="form_submit btn btn-primary">Submit</button>
                <a type="button" href="{{ route('users.index') }}" class="btn btn-primary"> Cancel </a>
            </form>
        </div>
        <script type="module">
            $(document).find('.cityies_selector').select2();
            $(document).on('change','.selectAll',function(){
                if($(this).val() == 'select'){
                    $('#role  option').prop("selected",true);
                    $('#role').trigger('change');
                }else{
                    $('#role  option:not(.no-clear-button)').prop("selected",false);
                    $('#role').trigger('change');
                }
            });
                $('.cityies_selector').select2({
                    dropdownParent: $('#default_modal')
                });
        </script>
        <style>
            span.select2-selection.select2-selection--multiple {
                max-height: 300px;
                overflow: scroll;
            }
        </style>
    </x-slot>
</x-custom-modal-component>