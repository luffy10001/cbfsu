<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Bid Bond Document </title>
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

        table td, table th {
            font-size: 10pt;
            font-weight: 400;
        }
        .pb-heading{
            font-size: 15px;
            margin-bottom: 10px;

        }
        .pb-heading-text{
            font-size: 13px;
            margin-top: 5px;
        }
        .pb-italic-text{
            font-size: 11px;
        }

        .line-container {
            width: 200px;
        }

        .line-row {
            display: flex;
        }

        .line-underline {
            flex-grow: 1;
            border-bottom: 1px solid black;
            margin-left: 5px;
        }

    </style>

</head>
<body>
    <table style="width: 100%;">
        <tr>
            <td style=" width: 20%; position: relative;">
                <div style="width: 130px; height: 120px">
                    <img src="{!! public_path('/images/bid_bond/liberty_image.png') !!}" style="max-width: 130%; max-height: 120%; object-fit: contain; display: block;">
                </div>
            </td>

            <td style="vertical-align: top; width: 80%; padding-top: 20px; padding-left: 30px">
                <strong style="font-size:35px; font-weight: 400;text-align: left; !important; ">Document A310<sup  style="font-size:18px;">TM</sup>-2010</strong><br>
                <strong>Confirms with The American Institute of Architects AIA Document 310</strong>
            </td>
        </tr>
    </table>
    <div> <strong style="font-size:20px;!important;"> <i> Bid Bond </i></strong> </div>

    <table style="vertical-align: top; width: 100%;">
        <tr>
            <td style="width: 50%;">
                <div class="pb-heading"> <strong> CONTRACTOR:</strong> </div>
                <div class="pb-heading-text"> <strong>Name:</strong> {!! $bond_data->customer->user->name !!}</div>
                <div class="pb-heading-text"> <strong> Address:</strong> {!! $bond_data->customer->address !!}</div>
                <div class="pb-heading-text"> <strong>City, ST, Zip: </strong> {!! $bond_data->customer->state->name !!}, {!! $bond_data->customer->city->name !!}, {!! $bond_data->customer->zip !!}</div>
            </td>

            <td style="vertical-align: top; width: 50%; text-align: left;">
                <div class="pb-heading"> <strong> SURETY:</strong> </div>
                <div class="pb-heading-text"> <strong>Name:</strong> {!! $bond_data->customer->authority->surerty->name !!}</div>
                <div class="pb-heading-text"> <strong>Address: </strong> {!! $bond_data->customer->authority->surerty->address !!}</div>
                <div class="pb-heading-text"> <strong>City, ST, Zip: </strong>{!! $bond_data->customer->authority->surerty->state->name !!}, {!! $bond_data->customer->authority->surerty->city->name !!}, {!! $bond_data->customer->authority->surerty->zip !!}</div>
            </td>
        </tr>
    </table>

    <br>

    <table style="width: 100%; margin-top: 3px;">
        <tr>
            <td style="vertical-align: top; width: 50%;">
                <div class="pb-heading"> <strong> OWNER:</strong> </div>
                <div class="pb-heading-text"> <strong>Name: </strong> {!! $bond_data->owner_name !!}</div>
                <div class="pb-heading-text"> <strong>Address: </strong> {!! $bond_data->owner_address !!}</div>
                <div class="pb-heading-text"> <strong>City, ST, Zip: </strong> {!! $bond_data->state->name !!}, {!! $bond_data->city->name !!}, {!! $bond_data->zip !!}</div>
            </td>
            <td style="vertical-align: top; width: 50%; text-align: left;">
                <div class="pb-heading"> <strong> MAILING ADDRESS FOR NOTICES:</strong> </div>
                <div style="margin-top: 10px;"> <strong>Name: </strong> {!! $bond_data->customer->authority->surerty->name !!}</div>
                <div style="margin-top: 5px;"> <strong>Address: </strong> {!! $bond_data->customer->authority->surerty->address !!}</div>
                <div style="margin-top: 5px;"> <strong>City, ST, Zip: </strong> {!! $bond_data->customer->authority->surerty->state->name !!}, {!! $bond_data->customer->authority->surerty->city->name !!}, {!! $bond_data->customer->authority->surerty->zip !!}</div>
            </td>
        </tr>
    </table>
    <div class="pb-italic-text"> <i> (This document has important legal consequences. Consultation with an attorney is encourage with respect to its completion or modification.) </i> </div>
    <div class="pb-italic-text"> <i> (Any singular references to Contractor, Surety, Owner or other party shall be considered plural where applicable) </i> </div>

    <br>

    <p style="font-size: 13px; text-align: center"> $10% of the Bid Amount</p>
    <strong style="font-size: 13px"> Project Description:</strong>
{{--    <div style="padding-top: 2px">Project :</div> <br>--}}
    <p style="font-size:10px; text-align: justify"> The Contractor and Surety are bound to the Owner in the amount set forth above, for the payment of which the Contractor and Surety bind themselves, their heirs, executors, administrators, successors and assigns, jointly and severally, as provided herein. The conditions of this Bond are such that if the Owner accepts the bid of the Contractor within the time specified in the bid documents, or within such time period as may be agreed to by the Owner and Contractor, and the Contractor either (1) enters into a contract with the Owner in accordance with the terms of such bid, and gives such bond or bonds as may be specified in the bidding or Contract Documents, with a surety admitted in the jurisdiction of the Project and otherwise acceptable to the Owner, for the faithful performance of such Contract and for the prompt payment Flabor and material furnished in the prosecution thereof, or (2) pays to the Owner the difference, not to exceed the amount of this Bond, between the amount specified in said bid and such larger amount for which the Owner may in good faith contract with another party to perform the work covered by said bid, then this obligation shall be null and void, otherwise to remain in full force and effect. The Surety hereby waives any notice of an agreement between the Owner and Contractor to extend the time in which the Owner may accept the bid. Waiver of notice by the Surety shall not apply to any extension exceeding sixty (60) days in the aggregate beyond the time for acceptance of bids specified in the bid documents, and the Owner and Contractor shall obtain the Surety's consent for an extension beyond sixty (60) days.</p>
    <p style="font-size:10px; text-align: justify"> If this Bond is issued in connection with a subcontractor's bid to a Contractor, the term Contractor in this Bond shall be deemed to be Subcontractor and the term Owner shall be deemed to be Contractor.</p>
    <p style="font-size:10px; text-align: justify"> When this Bond has been furnished to comply with a statutory or other legal requirement in the location of the Project, any provision in this Bond conflicting with said statutory or legal requirement shall be deemed deleted herefrom and provisions conforming to such statutory or other legal requirement shall be deemed incorporated herein. When so furnished, the intent is that this Bond shall be construed as a statutory bond and not as a common law bond.</p>
    <p style="font-size:10px; text-align: justify"> Signed abd sealed this<span class="line-underline" style=" width: 10%; display: inline-block;">&nbsp;</span>of<span class="line-underline" style=" width: 10%; display: inline-block;">&nbsp;</span>,<span class="line-underline" style=" width: 10%; display: inline-block;">&nbsp;</span></p>

    <br>

    <table style="width: 100%;">
        <tr>
            <td style="vertical-align: top; width: 40%; position: relative;">
                <div>
                    <span class="line-underline" style="border-bottom: 1px solid black; width: 80%; display: inline-block;">&nbsp;</span>
                </div>
                <span style="padding-left:7px; font-size: 11px" > <i>(Witness)</i></span>

                <div style="margin-top: 50px">
                    <span class="line-underline" style="border-bottom: 1px solid black; width: 80%; display: inline-block;">&nbsp;</span>
                </div>
                <span style="padding-left:7px; font-size: 11px" > <i>(Witness)</i></span>
            </td>

            <td style="vertical-align: top;float: left; width: 50%;">
                <div>
                    <span class="line-underline" style="border-bottom: 1px solid black; width: 100%; display: inline-block;">Client Name</span>
                </div>
                <span style="padding-left:7px; font-size: 11px" > <i>(Witness)</i></span>

                <div style="padding-top: 20px">
                    <span class="line-underline" style="border-bottom: 1px solid black; width: 100%; display: inline-block;">&nbsp;</span>
                </div>
                <span style="padding-left:7px; font-size: 11px" > <i>(Title)</i></span>

                <div style="padding-top: 20px">
                    <span class="line-underline" style="border-bottom: 1px solid black; width: 100%; display: inline-block;">Liberty Mutual Insurance Company</span>
                </div>
                <span style="padding-left:7px; font-size: 11px" > <i>(Surety)</i></span>

                <div style="padding-top: 20px">
                    <span class="line-underline" style="border-bottom: 1px solid black; width: 100%; display: inline-block;">&nbsp;</span>
                </div>
                <span style="padding-left:7px; font-size: 11px" >AIF Name Field Attorney-in-Fact</span>
            </td>
            <td style="vertical-align: top; width: 10%;">
                <div style="width: 50px; height: 50px; float: right; ">
                    <img src="{!! public_path('/images/bid_bond/bond_stamp.png') !!}" style="max-width: 130%; max-height: 120%; object-fit: contain; display: block; padding-top: 200%">
                </div>
            </td>
        </tr>
    </table>
    <br>
    <br>

    <hr>





</body>
</html>







