<x-custom-modal-component>
    <x-slot name="title">
        {{ __('Assign Agency to '.$user->name) }}
    </x-slot>
    <x-slot name="body">
        <style>
            ul, li{
                list-style: none;
                padding: 0;
            }
            p {
                color: #4f4f4f;
                font-family: sans-serif;
                line-height: 1.5;
                margin:0;
                text-align: right;
            }
            strong{
                float: left;
            }
        </style>
        <div class="modal-body">
            <div class="wrapper">
                <ul class="list-group">
                    <li class="list-group-item">
                        <p> <strong>City : </strong>{{$user->city->name}} </p>
                    </li>
                    <li class="list-group-item">
                        <p> <strong>Areas : </strong>
                            @foreach($user->user_areas as $area)
                                <span class="badge bg-secondary">{!! $area->area->name??'N/A' !!}</span>
                            @endforeach
                        </p>
                    </li>

                    <li class="list-group-item">
                        <p> <strong>Role : </strong>{{$user->role->name}} </p>
                    </li>
                    <li class="list-group-item">
                        <p> <strong>Assigned Agencies : </strong>
                            @foreach($user_agencies as $agency)
                                <span class="badge bg-secondary m-1">{!! $agency->name !!} - {{$agency->agency_id}}</span>
                            @endforeach
                        </p>
                    </li>
                </ul>
            </div>
            <form action="{{route('users.assign-agency-store',$user->id)}}" method="POST">
                <div class="mb-3">
                    <label for="role" class="form-label">Select a Agency</label>
                    <select multiple class="form-select ccrm-select" id="role" name="agency_id" required>
                        @foreach($agencies as $agency)
                            <option {!! $selfController->mws_user_agency($user_agencies,$agency->id)?'selected':'' !!}
                                    value={{$agency->id}}>
                                {!! agencyParam($agency) !!}&nbsp;&nbsp;({!! isset($agency->area) ? $agency->area->name : '' !!})
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="button" class="form_submit btn btn-primary">Submit</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                    Cancel
                </button>
            </form>
        </div>
    </x-slot>
</x-custom-modal-component>



{{--<div class="modal-body">--}}
{{--    <h3>Agency Lists</h3>--}}
{{--    <div>--}}
{{--        @foreach($user_agencies as $uagency)--}}
{{--            <span class="badge bg-secondary m-1">{!! $uagency['name'] !!}</span>--}}
{{--        @endforeach--}}
{{--    </div>--}}
{{--    <form action="{{route('users.assign-agency-store',$user->id)}}" method="POST">--}}
{{--        {!! dd($user_agencies,$agencies) !!}--}}
{{--        <div class="mb-3">--}}
{{--            <label for="role" class="form-label">Select a Agency</label>--}}
{{--            <select multiple class="form-select ccrm-select" id="role" name="agency_id" required>--}}

{{--                @foreach($agencies as $agency)--}}
{{--                    <option value={{$agency->id}}>{{$agency->name }}</option>--}}
{{--                @endforeach--}}
{{--            </select>--}}
{{--        </div>--}}
{{--        <button type="" class="form_submit btn btn-primary">Save</button>--}}
{{--    </form>--}}
{{--</div>--}}


{{--@foreach($agencies as $agency)--}}
{{--    <option {!! $selfController->mws_user_agency($user_agencies,$agency->id)?'selected':'' !!} value={{$agency->id}}>{{$agency->name }}</option>--}}
{{--@endforeach--}}