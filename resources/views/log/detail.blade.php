<x-custom-modal-component>
    <x-slot name="title">
        {{ __('Log Detail') }}
    </x-slot>

    <x-slot name="body">

        <style>
            ul, li {
                list-style: none;
                padding: 0;
            }

            .container {
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 0 1rem;
                background: white;
                padding: 3rem 0;
            }

            h1 {
                font-size: 1.1rem;
                font-family: sans-serif;
            }

            .sessions {
                margin-top: 2rem;
                border-radius: 12px;
                position: relative;
            }

            .sessions li {
                padding-bottom: 1.5rem;
                border-left: 1px solid #abaaed;
                position: relative;
                padding-left: 20px;
                margin-left: 10px;
            }

            .time {
                color: #2a2839;
                font-family: 'Poppins', sans-serif;
                font-weight: 500;
            }

            p {
                color: #4f4f4f;
                font-family: sans-serif;
                line-height: 1.5;
                margin: 0;
                text-align: right;
            }

            strong {
                float: left;
            }

            .wrapper {
                overflow-y: scroll;
                height: 500px;
            }
        </style>

        <div class="wrapper1">
            <table class="table table-bordered mws-class">
                <thead>
                <tr>
                    <th>Field</th>
                    <th>Old Value</th>
                    <th>New Value</th>
                </tr>
                </thead>
                <tbody>
                @if ($crmData->action!='delete')
                @foreach ($newCrmLogData as $key => $newValue)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>
                            @if($crmData->action !=='create')
                                @if (isset($oldCrmLogData[$key]))
                                    @if (is_array($oldCrmLogData[$key]))
                                        {{ implode(', ', $oldCrmLogData[$key]) }}
                                    @else
                                        @if(filter_var($oldCrmLogData[$key], FILTER_VALIDATE_URL))

                                            <a target="_blank" href="{!! $oldCrmLogData[$key] !!}">View Attachment</a>
                                        @else
                                            {{ $oldCrmLogData[$key]??'N/A' }}
                                        @endif
                                    @endif
                                @else
                                    N/A
                                @endif
                            @endif
                            @if($crmData->action =='create')
                                N/A
                            @endif
                        </td>
                        <td>{!!  is_array($newValue) ? implode(', ', $newValue) : (filter_var($newValue, FILTER_VALIDATE_URL)?'<a target="_blank" href="'.$newValue.'">View Attachment</a>':$newValue??'N/A') !!}</td>
                    </tr>
                @endforeach
                @else
                    @foreach ($oldCrmLogData as $key => $newsValue)
                        <tr>
                            <td>{{ $key??'N/A' }}</td>
                            <td>
                                {{ $newsValue??'N/A' }}
                            </td>
                            <td>N/A</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
        <style>
            .mws-class th,.mws-class td{
                width: 300px !important;
            }
        </style>
    </x-slot>
</x-custom-modal-component>