<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Monitoring Visit Report </title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: Arial, sans-serif; /* Use Arial font family as an example */
        }
        .headings{
            background-color: #edf7fe;
            text-align: center;
            border-top-left-radius: 10px; /* adjust the value as needed */
            border-top-right-radius: 10px;
            padding:15px;
            margin: 0;
            /*font-family: Arial, sans-serif;*/
            /*font-size: 14px;*/
            color: #474646;
            line-height: 1.3;
        }

        table {
            width: 50%; /* Set the table width to 50% */
            border-collapse: collapse;
            margin-top: 10pt;
        }

        table td, table th {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 10pt;
            font-weight: 400;
            text-align: left;
            padding-left: 10px;
        }

        table thead {
            background-color: #edf7fe;
        }

        strong {
            font-size: 16px;
            font-weight: 600;
            padding-bottom: 4px;
        }
        #td-bg-color{
            background-color:#f2f2f2;
        }

    </style>

</head>
<body>

<div class="margin-top"  >
    <div class="row">
        <div class="left-div">
{{--            <h3 class="accordion-header mt-4" id="headingFive" style="font-family: Arial, sans-serif;text-align: center">--}}
{{--                <strong style="font-weight: 400;font-size: 14pt;color:cornflowerblue;padding-top: 35px;text-align: center">--}}
{{--                    <i style="text-align: center"> Accelerated response to HIV through effective<br>--}}
{{--                        prevention, treatment, care and support interventions for<br>--}}
{{--                        Key Populations and surveillance in high risk areas</i>--}}
{{--                </strong>--}}
{{--            </h3>--}}
            <h3 class="accordion-header mt-4" id="headingFive" style="font-family: Arial, sans-serif;text-align: center">
                <strong style="font-size:22px; font-weight: 400;text-align: center !important;">Bid Bond Request Form</strong><br>
            </h3>
            <hr style="width: 112%">
        </div>
{{--        <img src="{{ public_path('images/undp.png') }}" alt="Logo" class="right-div">--}}
    </div>
</div>
{{--------------------------- Customer Information -----------------}}
<br>
<div class="panel-heading">
    <h6 class="accordion-header mt-4 headings" >
        <strong style="font-weight: 400;font-size: 12pt;"> &nbsp;Customer Information</strong>
    </h6>
</div>
<div class="row">
    <table class="w-full" style="width: 100%; border-collapse: collapse; margin-top: 10pt;">
        <tbody>
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px;"> Account Name   </td>
                <td style="border: 1px solid #ddd; padding: 8px;"> {{$user->name??''}} </td>
            </tr>
            <tr  >
                <td style="border: 1px solid #ddd; padding: 8px;"> Corporation Type   </td>
                <td style="border: 1px solid #ddd; padding: 8px;">  @if($c_user->corporation_type) {{ corporation_types()[$c_user->corporation_type] }} @endif   </td>
            </tr>
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px;"> Phone  </td>
                <td style="border: 1px solid #ddd; padding: 8px;">  {{ $c_user->phone??''}}  </td>
            </tr>
            <tr  >
                <td style="border: 1px solid #ddd; padding: 8px;">  Email  </td>
                <td style="border: 1px solid #ddd; padding: 8px;">  {{ $user->email??''}} </td>
            </tr>
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px;"> Average Project Size </td>
                <td style="border: 1px solid #ddd; padding: 8px;">  {{ $c_user->average_size??'' }}  </td>
            </tr>
            <tr  >
                <td style="border: 1px solid #ddd; padding: 8px; width: 50%;"> Largest Project Size </td>
                <td style="border: 1px solid #ddd; padding: 8px;">  {{ $c_user->largest_size}}  </td>
            </tr>
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px;"> Sate </td>
                <td style="border: 1px solid #ddd; padding: 8px;">  {{ $c_user->state->name??''}}  </td>
            </tr>
            <tr  >
                <td style="border: 1px solid #ddd; padding: 8px;"> City </td>
                <td style="border: 1px solid #ddd; padding: 8px;">  {{ $c_user->city->name??'' }} </td>
            </tr>
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px;"> Zip </td>
                <td style="border: 1px solid #ddd; padding: 8px;">  {{ $c_user->zip}}  </td>
            </tr>
            <tr  >
                <td style="border: 1px solid #ddd; padding: 8px;"> Address </td>
                <td style="border: 1px solid #ddd; padding: 8px;">  {{ $c_user->address }}  </td>
            </tr>

        </tbody>
    </table>
</div>
<br>
{{--{!! $c_user->authority !!}--}}
{{--------------------------- Line of Authority -----------------}}
<div class="panel-heading">
    <h6 class="accordion-header mt-4 headings" >
        <strong style="font-weight: 400;font-size: 12pt;"> &nbsp;Line of Authority</strong>
    </h6>
</div>
<div class="row">
    <table class="w-full" style="width: 100%; border-collapse: collapse; margin-top: 10pt;">
        <tbody>
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px; width: 50%;"> Effective Date    </td>
                <td style="border: 1px solid #ddd; padding: 8px;"> {{$c_user->authority->start_date ??''}} </td>
            </tr>
            <tr  >
                <td style="border: 1px solid #ddd; padding: 8px;"> Expiration Date Date   </td>
                <td style="border: 1px solid #ddd; padding: 8px;">  {{$c_user->authority->expiry_date ??''}}   </td>
            </tr>
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px;"> Territory  </td>
                <td style="border: 1px solid #ddd; padding: 8px;">  {{$c_user->authority->territory ??''}} </td>
            </tr>
            <tr  >
                <td style="border: 1px solid #ddd; padding: 8px;">  Single Project Limit</td>
                <td style="border: 1px solid #ddd; padding: 8px;">  {{$c_user->authority->single_job_limit ??''}} </td>
            </tr>
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px;"> Aggregate Limit</td>
                <td style="border: 1px solid #ddd; padding: 8px;">  {{$c_user->authority->aggregate_limit ??''}}  </td>
            </tr>
            <tr  >
                <td style="border: 1px solid #ddd; padding: 8px;"> Design Build </td>
                <td style="border: 1px solid #ddd; padding: 8px;">  @if($c_user->authority) {{$c_user->authority->design_build==true ? 'Yes' : 'No'}} @endif  </td>
            </tr>
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px;"> Job Duration (Years) </td>
                <td style="border: 1px solid #ddd; padding: 8px;">  {{$c_user->authority->job_duration ??''}}  </td>
            </tr>
            <tr  >
                <td style="border: 1px solid #ddd; padding: 8px;"> Warranty Period (years) </td>
                <td style="border: 1px solid #ddd; padding: 8px;">  {{$c_user->authority->warranty_duration ??''}}  </td>
            </tr>
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px;"> Hazmat/Asbestos </td>
                <td style="border: 1px solid #ddd; padding: 8px;">  @if($c_user->authority) {{$c_user->authority->hazmat==true ? 'Yes' : 'No'}} @endif </td>
            </tr>
            <tr  >
                <td style="border: 1px solid #ddd; padding: 8px;"> Bid Spread % </td>
                <td style="border: 1px solid #ddd; padding: 8px;">  {{$c_user->authority->minimum_bid ??''}}  </td>
            </tr>
        </tbody>
    </table>
</div>
<br>
<br>
<br>
<br>

{{--------------------------- The Project -----------------}}
<div class="panel-heading">
    <h6 class="accordion-header mt-4 headings" >
        <strong style="font-weight: 400;font-size: 12pt;"> &nbsp;The Project</strong>
    </h6>
</div>
<div class="row">
    <table class="w-full" style="width: 100%; border-collapse: collapse; margin-top: 10pt;">
        <tbody>
        <tr>
            <td style="border: 1px solid #ddd; padding: 8px;width: 50%;"> Project Name    </td>
            <td style="border: 1px solid #ddd; padding: 8px;"> {{$bond->name ??''}} </td>
        </tr>
        <tr  >
            <td style="border: 1px solid #ddd; padding: 8px;"> Project State   </td>
            <td style="border: 1px solid #ddd; padding: 8px;">  {{$bond->state->name ??''}}   </td>
        </tr>
        <tr>
            <td style="border: 1px solid #ddd; padding: 8px;"> Project City  </td>
            <td style="border: 1px solid #ddd; padding: 8px;">  {{$bond->city->name ??''}} </td>
        </tr>
        <tr  >
            <td style="border: 1px solid #ddd; padding: 8px;">  Project Zip </td>
            <td style="border: 1px solid #ddd; padding: 8px;">  {{$bond->zip ??''}} </td>
        </tr>
        <tr>
            <td style="border: 1px solid #ddd; padding: 8px;"> Project Address </td>
            <td style="border: 1px solid #ddd; padding: 8px;">  {{$bond->address ??''}}  </td>
        </tr>
        <tr  >
            <td style="border: 1px solid #ddd; padding: 8px;"> Project Delivery Method </td>
            <td style="border: 1px solid #ddd; padding: 8px;"> {{$bond->delivery_method ??''}}  </td>
        </tr>
        <tr>
            <td style="border: 1px solid #ddd; padding: 8px;"> Estimate Project Start Date </td>
            <td style="border: 1px solid #ddd; padding: 8px;">  {{$bond->start_date ??''}}  </td>
        </tr>
        <tr  >
            <td style="border: 1px solid #ddd; padding: 8px;"> Estimate Project Completion Date </td>
            <td style="border: 1px solid #ddd; padding: 8px;">  {{$bond->completion_date ??''}}  </td>
        </tr>
        <tr>
            <td style="border: 1px solid #ddd; padding: 8px;"> Liquidated Damages </td>
            <td style="border: 1px solid #ddd; padding: 8px;">  {{$bond->damages ??''}}  </td>
        </tr>
        <tr  >
            <td style="border: 1px solid #ddd; padding: 8px;"> Retainage Amount </td>
            <td style="border: 1px solid #ddd; padding: 8px;">  {{$bond->retain_amount ??''}}  </td>
        </tr>
        <tr>
            <td style="border: 1px solid #ddd; padding: 8px;"> Current Backlog </td>
            <td style="border: 1px solid #ddd; padding: 8px;">  {{$bond->current_backlog ??''}}  </td>
        </tr>
        <tr  >
            <td style="border: 1px solid #ddd; padding: 8px;"> GPM </td>
            <td style="border: 1px solid #ddd; padding: 8px;">  {{$bond->gpm ??''}}  </td>
        </tr>
        <tr>
            <td style="border: 1px solid #ddd; padding: 8px;"> Engineer Name </td>
            <td style="border: 1px solid #ddd; padding: 8px;">  {{$bond->engineer_name ??''}}  </td>
        </tr>
        <tr  >
            <td style="border: 1px solid #ddd; padding: 8px;"> Oblige/Owner Name </td>
            <td style="border: 1px solid #ddd; padding: 8px;">  {{$bond->owner_name ??''}}  </td>
        </tr>
        <tr>
            <td style="border: 1px solid #ddd; padding: 8px;"> Oblige/Owner State </td>
            <td style="border: 1px solid #ddd; padding: 8px;">  {{$bond->states->name ??''}}  </td>
        </tr>
        <tr  >
            <td style="border: 1px solid #ddd; padding: 8px;"> Oblige/Owner City </td>
            <td style="border: 1px solid #ddd; padding: 8px;">  {{$bond->cities->name ??''}}  </td>
        </tr>
        <tr>
            <td style="border: 1px solid #ddd; padding: 8px;"> Oblige/Owner Zip </td>
            <td style="border: 1px solid #ddd; padding: 8px;">  {{$bond->owner_zip ??''}}  </td>
        </tr>
        <tr  >
            <td style="border: 1px solid #ddd; padding: 8px;"> Oblige/Owner Address </td>
            <td style="border: 1px solid #ddd; padding: 8px;">  {{$bond->owner_address ??''}}  </td>
        </tr>
        </tbody>
    </table>
</div>
<br>

{{--------------------------- Bid Bond -----------------}}
<div class="panel-heading">
    <h6 class="accordion-header mt-4 headings" >
        <strong style="font-weight: 400;font-size: 12pt;"> &nbsp;Bid Bond</strong>
    </h6>
</div>
<div class="row">
    <table class="w-full" style="width: 100%; border-collapse: collapse; margin-top: 10pt;">
        <tbody>
        <tr  >
            <td style="border: 1px solid #ddd; padding: 8px;width: 50%;"> Estimated Start Date    </td>
            <td style="border: 1px solid #ddd; padding: 8px;"> {{$bond->bid_start_date ??''}} </td>
        </tr>
        <tr>
            <td style="border: 1px solid #ddd; padding: 8px;"> Substantial Completion Date   </td>
            <td style="border: 1px solid #ddd; padding: 8px;">  {{$bond->bid_completion_date ??''}}   </td>
        </tr>

        <tr  >
            <td style="border: 1px solid #ddd; padding: 8px;">  Bid Date </td>
            <td style="border: 1px solid #ddd; padding: 8px;">  {{$bond->owner_bid_date ??''}} </td>
        </tr>
        <tr>
            <td style="border: 1px solid #ddd; padding: 8px;"> How Much Will You Bid $ </td>
            <td style="border: 1px solid #ddd; padding: 8px;">  {{$bond->bid_amount ??''}} </td>
        </tr>

        <tr  >
            <td style="border: 1px solid #ddd; padding: 8px;"> What is Your Project Cost $ </td>
            <td style="border: 1px solid #ddd; padding: 8px;"> {{$bond->bid_project_cost ??''}}  </td>
        </tr>
        <tr>
            <td style="border: 1px solid #ddd; padding: 8px;">  Amount of Bid Bond (i.e. 5%, 10%, etc.) </td>
            <td style="border: 1px solid #ddd; padding: 8px;">  {{$bond->bid_amount_percentage ??''}} </td>
        </tr>

        <tr  >
            <td style="border: 1px solid #ddd; padding: 8px;"> Warranty Period</td>
            <td style="border: 1px solid #ddd; padding: 8px;">  {{$bond->bid_warranty_period ??''}}  </td>
        </tr>
        <tr >
            <td style="border: 1px solid #ddd; padding: 8px;"> Liquidated Damages </td>
            <td style="border: 1px solid #ddd; padding: 8px;">  {{$bond->bid_damages ??''}}  </td>
        </tr>
        </tbody>
    </table>
</div>
<br>


</body>

{{--</body>--}}
</html>
