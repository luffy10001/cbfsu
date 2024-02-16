<x-custom-modal-component>
    <x-slot name="title">
            {{ __('Role Date Visibilty') }}
    </x-slot>
  
    <x-slot name="body">
        <div class="modal-body">
            <form action="{{route("roles.visibility.update")}}" method="POST">
                @csrf
                <style>
                    ul, li{
                        list-style: none;
                        padding: 0;
                    }
                    .container{
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        padding: 0 1rem;
                        background: white;
                        padding: 3rem 0;
                    }
                    h1{
                        font-size: 1.1rem;
                        font-family: sans-serif;
                    }
                    .sessions{
                        margin-top: 2rem;
                        border-radius: 12px;
                        position: relative;
                    }
                    .sessions li{
                        padding-bottom: 1.5rem;
                        border-left: 1px solid #abaaed;
                        position: relative;
                        padding-left: 20px;
                        margin-left: 10px;
                    }
                    .time{
                        color: #2a2839;
                        font-family: 'Poppins', sans-serif;
                        font-weight: 500;
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
                <input type="hidden" name="role_id" id="role_id" value="{{$role->id}}">
                <div class="wrapper">
                    @if($role->id == 5 || $role->id == 4 || $role->id == 2 ||  $role->id == 6  || $role->id == 3 || $role->id == 8 || $role->id == 12)
                        <ul class="list-group">
                            <li class="list-group-item">
                                <p> <strong>Personals : </strong><input type="checkbox" class="form-check-label" id="personal" name="personal" <?php if(isset($data->personal) && $data->personal == true) { ?> checked <?php } ?> ></p>
                            </li>
                        </ul>
                    @endif

                    @if($role->id == 4 || $role->id == 8 || $role->id == 6 || $role->id == 2 || $role->id == 3)
                        <ul class="list-group">
                            <li class="list-group-item">
                                <p> <strong>Team : </strong><input type="checkbox" class="form-check-label" id="team" name="team" <?php if(isset($data->team) && $data->team == true) { ?> checked <?php } ?> >
                                </p>
                            </li>
                        </ul>
                    @endif

{{--                    @if( )--}}
{{--                         <ul class="list-group">--}}
{{--                            <li class="list-group-item">--}}
{{--                                <p> <strong>Area Agency : </strong><input type="checkbox" class="form-check-label" id="assign_agency" name="assign_agency" <?php if(isset($data->assign_agency) && $data->assign_agency == true) { ?> checked <?php } ?> ></p>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    @endif--}}

                    @if($role->id == 13 || $role->id == 14 || $role->id == 11  || $role->id == 9|| $role->id == 10 || $role->id == 7 )
                        <ul class="list-group">
                            <li class="list-group-item">
                                <p> <strong>Assign Area : </strong><input type="checkbox" class="form-check-label" id="assign_area" name="assign_area" <?php if(isset($data->assign_area) && $data->assign_area == true) { ?> checked <?php } ?> ></p>
                            </li>
                        </ul>
                    @endif
                </div>
                <button type="button" class="btn btn-primary form_submit mt-2" >Submit</button>
            </form>
        </div>
    </x-slot>
</x-custom-modal-component>