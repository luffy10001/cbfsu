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
            font-family: Arial, sans-serif;
            font-size: 14px;
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
            <h3 class="accordion-header mt-4" id="headingFive" style="font-family: Arial, sans-serif;text-align: center">
                <strong style="font-size:22px; font-weight: 400;text-align: center !important;">Bid Bond Request Form</strong><br>
            </h3>
            <hr style="width: 112%">
        </div>
    </div>
</div>
{{--------------------------- Customer Information -----------------}}

<br>
<div class="panel-heading">
    <h6 class="accordion-header mt-4 headings" >
        <strong> Customer Information </strong>
    </h6>
</div>
<div class="row">
    <table class="w-full" style="width: 100%; border-collapse: collapse; margin-top: 10pt;">
{{--        <tbody>--}}
{{--        <tr>--}}
{{--            <td style="border: 1px solid #ddd; padding: 8px;"> Account Name   </td>--}}
{{--            <td style="border: 1px solid #ddd; padding: 8px;"> {{$user->name??''}} </td>--}}
{{--        </tr>--}}
{{--        <tr id="td-bg-color">--}}
{{--            <td style="border: 1px solid #ddd; padding: 8px;"> Corporation Type   </td>--}}
{{--            <td style="border: 1px solid #ddd; padding: 8px;">  {{ corporation_types()[$c_user->corporation_type]    }}   </td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td style="border: 1px solid #ddd; padding: 8px;"> Phone  </td>--}}
{{--            <td style="border: 1px solid #ddd; padding: 8px;">  {{ $c_user->phone??''}}  </td>--}}
{{--        </tr>--}}
{{--        <tr id="td-bg-color">--}}
{{--            <td style="border: 1px solid #ddd; padding: 8px;">  Email  </td>--}}
{{--            <td style="border: 1px solid #ddd; padding: 8px;">  {{ $user->email??''}} </td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td style="border: 1px solid #ddd; padding: 8px;"> Average Project Size </td>--}}
{{--            <td style="border: 1px solid #ddd; padding: 8px;">  {{ $c_user->average_size??'' }}  </td>--}}
{{--        </tr>--}}
{{--        <tr id="td-bg-color">--}}
{{--            <td style="border: 1px solid #ddd; padding: 8px; width: 50%;"> Largest Project Size </td>--}}
{{--            <td style="border: 1px solid #ddd; padding: 8px;">  {{ $c_user->largest_size}}  </td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td style="border: 1px solid #ddd; padding: 8px;"> Sate </td>--}}
{{--            <td style="border: 1px solid #ddd; padding: 8px;">  {{ $c_user->state->name}}  </td>--}}
{{--        </tr>--}}
{{--        <tr id="td-bg-color">--}}
{{--            <td style="border: 1px solid #ddd; padding: 8px;"> City </td>--}}
{{--            <td style="border: 1px solid #ddd; padding: 8px;">  {{ $c_user->city->name??'' }} </td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td style="border: 1px solid #ddd; padding: 8px;"> Zip </td>--}}
{{--            <td style="border: 1px solid #ddd; padding: 8px;">  {{ $c_user->zip}}  </td>--}}
{{--        </tr>--}}
{{--        <tr id="td-bg-color">--}}
{{--            <td style="border: 1px solid #ddd; padding: 8px;"> Address </td>--}}
{{--            <td style="border: 1px solid #ddd; padding: 8px;">  {{ $c_user->address }}  </td>--}}
{{--        </tr>--}}

{{--        </tbody>--}}
    </table>
</div>
<br>
</body>

{{--</body>--}}
</html>
