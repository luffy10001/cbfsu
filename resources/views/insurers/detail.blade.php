<x-custom-modal-component>
    <x-slot name="title">
        {{ __('User Details') }}
    </x-slot>

    <x-slot name="body">

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
            .wrapper{
                overflow-y: scroll;
                height: 500px;
            }
        </style>

        <div class="wrapper">
            <ul class="list-group">
                <li class="list-group-item">
                    <p> <strong>Department Name : </strong>{{$data->department->name??'N/A'}} </p>
                </li>

                <li class="list-group-item">
                    <p> <strong>Role: </strong>{{$data->role->name??'N/A'}} </p>
                </li>
                <li class="list-group-item">
                    <p> <strong>Manager Name: </strong>
                        @if($manager)
                            {{$manager->name??''}} - {{$manager->role->name??''}}
                        @else
                            N/A
                        @endif
                    </p>
                </li>

                <li class="list-group-item">
                    <p> <strong>Name: </strong>{{$data->name??'N/A'}}  </p>
                </li>
                <li class="list-group-item">
                    <p> <strong>Email: </strong>{{$data->email??'N/A'}}</p>
                </li>
                <li class="list-group-item">
                    <p> <strong>Phone: </strong> {{$data->phone??'N/A'}}</p>
                </li>
                @if(isset($data->phone1))
                    <li class="list-group-item">
                        <p> <strong>Phone1: </strong>{{$data->phone1??'N/A'}}</p>
                    </li>
                @endif
                @if(isset($data->phone2))
                    <li class="list-group-item">
                        <p> <strong>Phone2: </strong>{{$data->phone2??'N/A'}}</p>
                    </li>
                @endif
                @if(isset($data->phone3))
                    <li class="list-group-item">
                        <p> <strong>Phone3: </strong>{{$data->phone3??'N/A'}}</p>
                    </li>
                @endif
                @if(isset($data->phone4))

                    <li class="list-group-item">
                        <p> <strong>Phone4: </strong>{{$data->phone4??'N/A'}}</p>
                    </li>
                @endif
                <li class="list-group-item">
                    <p> <strong>City: </strong>{{$data->city->name??'N/A'}}</p>
                </li>
                <li class="list-group-item">
                    <p> <strong>Office: </strong>{{$data->office??'N/A'}}</p>
                </li>
                <li class="list-group-item">
                    <p> <strong>Created Date: </strong>{{$data->created_at??'N/A'}}</p>
                </li>
                <li class="list-group-item">
                    <p> <strong>Updated Date: </strong>{{$data->updated_at??'N/A'}}</p>
                </li>


                <li class="list-group-item">
                    <p> <strong>Assigned Areas: </strong>
                    @foreach($areas as $area)
                            <span class="badge bg-secondary">  {{$area->area->name}}</span>
                    @endforeach
                    </p>
                </li>
                <li class="list-group-item">
                    <p> <strong>Assigned Agencies: </strong>
                        @foreach($agencies as $agency)
                            <span class="badge bg-secondary">  {{agencyParam($agency->assigned_agency)}}</span>
                        @endforeach
                    </p>
                </li>

            </ul>
        </div>

        <div class="modal-body">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100 text-right m-3">
                            {{ Session::get('success') }}
                        </div>
                        <div>
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{ $dataTable->scripts() }}
    </x-slot>
</x-custom-modal-component>


