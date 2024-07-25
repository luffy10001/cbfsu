<x-custom-modal-component>
    <x-slot name="title">
        {{ __('Authority Details') }}
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
                    <p> <strong>Insurer Name : </strong>{{$authority_value['insurer_name']??'N/A'}} </p>
                </li>

                <li class="list-group-item">
                    <p> <strong>Start Date: </strong>{{$authority_value['start_date']??'N/A'}} </p>
                </li>
                <li class="list-group-item">
                    <p> <strong>Expiry Date: </strong>{{$authority_value['expiry_date']??'N/A'}}  </p>
                </li>
                <li class="list-group-item">
                    <p> <strong>Single Job Limit: </strong>{{$authority_value['single_job_limit']??'N/A'}}</p>
                </li>
                <li class="list-group-item">
                    <p> <strong>Aggregate Limit: </strong> {{$authority_value['aggregate_limit']??'N/A'}}</p>
                </li>
                <li class="list-group-item">
                    <p> <strong>Minimum Bid(%): </strong>{{$authority_value['minimum_bid']??'N/A'}}</p>
                </li>
                <li class="list-group-item">
                    <p> <strong>Territory: </strong>{{$authority_value['territory'].' '.territory_units()[$authority_value['territory_unit']]??'N/A'}}</p>
                </li>
                <li class="list-group-item">
                    <p> <strong>Job Duration: </strong>{{$authority_value['job_duration'].' '.days_unit()[$authority_value['job_duration_unit']]??'N/A'}}</p>
                </li>
                <li class="list-group-item">
                    <p> <strong>Warranty Duration: </strong>{{$authority_value['warranty_duration'].' '.days_unit()[$authority_value['warranty_duration_unit']]??'N/A'}}</p>
                </li>
                <li class="list-group-item">
                    <p> <strong>Payment Intervals: </strong>{{$authority_value['payment_interval'].' '.days_unit()[$authority_value['payment_interval_unit']]??'N/A'}}</p>
                </li>
                <li class="list-group-item">
                    <p> <strong>Maintenance Limit: </strong>{{$authority_value['maintenance_limit'].' '.days_unit()[$authority_value['maintenance_limit_unit']]??'N/A'}}</p>
                </li>

            </ul>
        </div>
    </x-slot>
</x-custom-modal-component>


