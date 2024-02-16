<div class="row serviceName">
    <div class="col-md-12">
        <p>{{$service->name}}</p>
    </div>
</div>
<div class="row indicatorsRow">
    @foreach($service->indicators as $indicator)
        <div class="col-md-11">
            <p>{{$indicator->name}}</p>
        </div>
        <div class="col-md-1">
            @if(isPermission('indicator.edit'))
                <a class="dropdown-item modal_open" url="{!! route('indicator.edit',$indicator->id) !!}"><i class="bi bi-pencil-fill text-primary"></i></a>
            @endif
            @if(isPermission('indicator.delete'))
                <a class="dropdown-item modal_submit" url="{!! route('indicator.delete',mws_encrypt('E',$indicator->id)) !!}"  swal_text="Do you want to delete this record?" swal_title="Are you sure?" swal_icon="warning" swal_button="Yes"><i class="bi bi-trash text-danger"></i></a>

            @endif
        </div>
    @endforeach
</div>

{{--<li class="serviceName">--}}
{{--    <strong>{{$service->name}}</strong>--}}
{{--</li>--}}
{{--@foreach($service->indicators as $indicator)--}}
{{--    <li>--}}
{{--        {{$indicator->name}}--}}
{{--    </li>--}}
{{--    <li>--}}
{{--            @if(isPermission('indicator.edit'))--}}
{{--                <a class="dropdown-item modal_open" url="{!! route('indicator.edit',$indicator->id) !!}">Edit</a>--}}
{{--            @endif--}}
{{--            @if(isPermission('indicator.delete'))--}}
{{--                <a class="dropdown-item modal_submit" url="{!! route('indicator.delete',mws_encrypt('E',$indicator->id)) !!}"  swal_text="Do you want to delete this record?" swal_title="Are you sure?" swal_icon="warning" swal_button="Yes"><i class="bi bi-trash text-danger"></i>  Delete</a>--}}

{{--            @endif--}}
{{--    </li>--}}
{{--@endforeach--}}

{{--    @if(isPermission('indicator.status'))--}}
{{--        @if($indicator->status === true)--}}
{{--            <li>--}}
{{--                <a class="dropdown-item modal_submit" url="{!! route('indicator.status',[$indicator->id,0]) !!}"  swal_text="Do you want to De-Activate this Indicator?" swal_title="Are you sure?" swal_icon="warning" swal_button="Yes, De-Activate it!"><i class="bi bi-door-closed"></i>--}}
{{--                    De-Activate</a>--}}
{{--            </li>--}}
{{--        @endif--}}
{{--        @if($indicator->status === false)--}}
{{--            <li>--}}
{{--                <a class="dropdown-item modal_submit" url="{!! route('indicator.status',[$indicator->id,1]) !!}"  swal_text="Do you want to Active this Indicator?" swal_title="Are you sure?" swal_icon="warning" swal_button="Yes, Active it!"><i class="bi bi-door-closed"></i>--}}
{{--                    Activate</a>--}}
{{--            </li>--}}
{{--        @endif--}}
{{--    @endif--}}


