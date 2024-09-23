<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Monitoring Visit Report </title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">--}}
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
    <p style="font-size:12px; text-align: right; margin-top: 3px;">Bond No: Bond Number </p>

    <div class="row">
        <div class="left-div" style="font-family: Arial, sans-serif; text-align: center">
                <strong style="font-size:35px; font-weight: 400;text-align: center; margin-bottom: 3px; !important; ">Document A312<sup  style="font-size:18px;">TM</sup>-2010</strong><br>
                <p style="font-size:12px; text-align: center; margin-top: 3px;">Conforms with The American Institute of Architects AIA Document 312 </p>
               <strong style="font-size:20px; float: left; margin-bottom: 5px; !important;"> <i>Performance Bond </i></strong><br>
            <br>
        </div>
    </div>

    {{--<table style="width: 100%; margin-top: 5px">
        <tr>
            <td style="vertical-align: top; width: 50%;">
                <strong class="pb-heading" style="margin-top: 40%">CONTRACTOR:</strong> <br>
                <strong class="pb-heading-text">Name:</strong> {!! $bond_data->customer->user->name !!}<br>
                <strong class="pb-heading-text">Address:</strong> {!! $bond_data->customer->address !!}<br>
                <strong class="pb-heading-text">City, ST, Zip:</strong> {!! $bond_data->customer->state->name !!}, {!! $bond_data->customer->city->name !!}, {!! $bond_data->customer->zip !!}
            </td>

            <td style="vertical-align: top; width: 50%; text-align: left;">
                <strong class="pb-heading">SURETY:</strong> <br>
                <strong class="pb-heading-text">Name:</strong> {!! $bond_data->customer->authority->surerty->name !!}<br>
                <strong class="pb-heading-text">Address:</strong> {!! $bond_data->customer->authority->surerty->address !!}<br>
                <strong class="pb-heading-text">City, ST, Zip:</strong> {!! $bond_data->customer->authority->surerty->state->name !!}, {!! $bond_data->customer->authority->surerty->city->name !!}, {!! $bond_data->customer->authority->surerty->zip !!}
            </td>
        </tr>
    </table>--}}

    <table style="width: 100%; margin-top: 5px;">
        <tr>
            <td style="vertical-align: top; width: 50%;">
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

    <br>

    <table style="width: 100%; margin-top: 3px">
        <tr>
            <td style="vertical-align: top; width: 100%;">
                <div class="pb-heading"> <strong> CONSTRUCTION CONTRACT:</strong> </div>
                <div class="pb-heading-text"> <strong>Date: </strong> Contract Date</div>
                <div class="pb-heading-text"> <strong>Amount: </strong> $Contract Amount</div>
                <div class="pb-heading-text"> <strong>Description: </strong></div>
            </td>
        </tr>
    </table>

    <br>

    <table style="width: 100%; margin-top: 3px">
        <tr>
            <td style="vertical-align: top; width: 100%;">
                <div class="pb-heading"> <strong> Project Description:</strong> </div>
            </td>
        </tr>
    </table>

    <br>

    <table style="width: 100%; margin-top: 3px">
        <tr>
            <td style="vertical-align: top; width: 100%;">
                <div class="pb-heading"> <strong> BOND:</strong> </div>
                <div class="pb-heading-text"> <strong>Date: </strong> Contract Date</div>
                <div class="pb-heading-text"> <i> (Not earlier than Construction Contract Date) </i> </div>
                <div class="pb-heading-text"> <strong>Amount: </strong> $Bond Amount</div>
                <div class="pb-heading-text"> <strong>Modification to this Bond: </strong> <input type="checkbox">None <input type="checkbox">See Section 16 </div>
            </td>
        </tr>
    </table>

    <br>

    <table style="width: 100%; margin-top: 3px;">
        <tr>
            <td style="vertical-align: top; width: 50%;">
                <div class="pb-heading"> <strong> CONTRACTOR AS PRINCIPLE:</strong> </div>
                <div class="pb-heading-text"> <strong>Company: </strong> </div>
                <div class="pb-heading-text"> <strong>Contractor Name: </strong> </div>
                <div class="pb-heading-text" style="margin-top: 25px !important;"> <strong>Signature: </strong> --------------------------------  </div>
                <div style="margin-top: 5px;"> <strong>Name and Title: </strong> </div>

            </td>
            <td style="vertical-align: top; width: 50%; text-align: left;">
                <div class="pb-heading"> <strong> SURETY:</strong> </div>
                <div style="margin-top: 10px;"> <strong>Company: </strong> </div>
                <div style="margin-top: 5px;"> <strong>Surety Name: </strong> {!! $bond_data->customer->authority->surerty->name!!}</div>
                <div class="pb-heading-text" style="margin-top: 25px !important;"> <strong>Signature: </strong> --------------------------------  </div>
                <div style="margin-top: 5px;"> <strong>Name and Title: </strong> </div>
            </td>
        </tr>
    </table>

    <br>

    <div style="font-family: Arial, sans-serif; text-align: left">
        <i style="font-size:12px; margin-top: 3px;">(Any additional signatures appear on the last page of this Performance Bond ) </i><br>
        <i style="font-size:12px; margin-top: 3px;">(FOR INFORMATION ONLY -- Name, address and telephone ) </i>
    </div>

    <br>

    <table style="width: 100%; margin-top: 1px;">
        <tr>
            <td style="vertical-align: top; width: 50%;">
                <div class="pb-heading-text"> <strong> AGENT</strong> or <strong>BROKER:</strong>   </div>
                <div class="pb-heading-text" > Fontana Insurance Solutions,</div>
                <div class="pb-heading-text" > LLC 504 S Niagara St </div>
                <div class="pb-heading-text" > Maquoketa, IA 52060</div>

{{--                <div class="pb-heading-text"> <strong>Company: </strong> </div>--}}
{{--                <div class="pb-heading-text"> <strong>Contractor Name: </strong> </div>--}}
{{--                <div class="pb-heading-text" style="margin-top: 25px !important;"> <strong>Signature: </strong> --------------------------------  </div>--}}
{{--                <div style="margin-top: 5px;"> <strong>Name and Title: </strong> </div>--}}

            </td>
            <td style="vertical-align: top; width: 50%; text-align: left;">
                <div class="pb-heading"> <strong> OWNER'S REPRESENTATIVE:</strong> </div>
                <i style="font-size:12px; margin-top: 3px;">(Architect, Engineer or other party:) </i>
{{--                <div style="margin-top: 10px;"> <strong>Company: </strong> </div>--}}
{{--                <div style="margin-top: 5px;"> <strong>Surety Name: </strong> {!! $bond_data->customer->authority->surerty->name!!}</div>--}}
{{--                <div class="pb-heading-text" style="margin-top: 25px !important;"> <strong>Signature: </strong> --------------------------------  </div>--}}
{{--                <div style="margin-top: 5px;"> <strong>Name and Title: </strong> </div>--}}
            </td>
        </tr>
    </table>
    <hr style="width: 100%">

    <p style="font-size:12px;"> <strong> §1 </strong> The Contractor and Surety, jointly and severally, bind themselves, their heirs, executors, administrators, successors and assigns to the Owner for the performance of the Construction Contract, which is incorporated herein by reference.</p>
    <p style="font-size:12px;"> <strong> §2 </strong> If the Contractor performs the Construction Contract, the Surety and the Contractor shall have no obligation under this Bond, except when applicable to participate in a conference as provided in Section 3. </p>
    <p style="font-size:12px;"> <strong> §3 </strong> If there is no Owner Default under the Construction Contract, the Surety's obligation under this Bond shall arise after . </p>

    <ol style="font-size:12px ;padding-left: 40px;">
        <li>
            the Owner first provides notice to the Contractor and the Surety that the Owner is considering declaring a
            Contractor Default.  Such notice shall indicate whether the Owner is requesting a conference between the Owner, Contractor and Surety to discuss the Contractor's performance. If the Owner does not request a conference, the Surety may, within five (5) business days after receipt of the Owner's notice, request such a conference. If the Surety timely requests a conference, the Owner shall attend. Unless the Owner
            agrees otherwise, any conference requested under this Section 3.1 shall be held within ten (10) business days of the Surety's receipt
            of the Owner's notice. If the Owner, the Contractor and the Surety agree, the Contractor shall be allowed a reasonable time to
            perform the Construction Contract, but such an agreement shall not waive the Owner's right, if any, subsequently to declare a Default Contractor;
        </li>
        <li>the Owner declares.2 a Contractor Default, terminates the Construction Contract and notifies the Surety, </li>
        <li>the Owner has agreed to pay the Balance of the Contract Price in accordance with the terms of the Construction Contract to the Surety or to a selected contractor to perform the Construction Contract</li>
    </ol>

    <p style="font-size:12px;"> <strong> §4 </strong> Failure on the part of the Owner to comply with the notice requirement in Section 3.1 shall not constitute a failure to comply with a condition precedent to the Surety's obligations, or release the Surety from its obligations, except to the extent the Surety demonstrates actual prejudice. </p>
    <p style="font-size:12px;"> <strong> §5 </strong> When the Owner has satisfied the conditions of Section 3, the Surety shall promptly and at the Surety's expense take one of the following actions: </p>
    <p style="font-size:12px;"> <strong> §5.1 </strong> Arrange for the Contractor, with the consent of the Owner, to perform and complete the Construction Contract</p>
    <p style="font-size:12px;"> <strong> §5.2 </strong> Undertake to perform and complete the Construction Contract itself, through its agents or independent contractors, </p>
    <p style="font-size:12px;"> <strong> §5.3 </strong> Obtain bids or negotiated proposals from qualified contractors acceptable to the Owner for a contract for performance and completion of the Construction Contract, arrange for a contract to be prepared for execution by the Owner and a contractor selected with the Owner's concurrence, to be secured with performance and payment bonds executed by a qualified surety equivalent to the bonds issued on the Construction Contract, and pay to the Owner the amount of damages as described in Section 7 in excess of the Balance of the Contract Price incurred by the Owner as a result of the Contractor Default, or </p>
    <p style="font-size:12px;"> <strong> §5.4 </strong> Waive its right to perform and complete, arrange for completion, or obtain a new contractor and with reasonable promptness under the circumstances: </p>
    <ol style="font-size:12px ;padding-left: 40px;">
        <li>After investigation, determine the amount for which it may be liable to the Owner and, as soon as practicable after the amount is determined, make payment to the Owner, or </li>
        <li>Deny liability in whole or in part and notify the Owner, citing the reasons for denial. </li>
    </ol>
    <p style="font-size:12px;"> <strong> §6 </strong> If the Surety does not proceed as provided in Section 5 with reasonable promptness, the Surety shall be deemed to be in default on this Bond seven days after receipt of an additional written notice from the Owner to the Surety demanding that the Surety perform its obligations under this Bond, and the Owner shall be entitled to enforce any remedy available to the Owner. If the Surety proceeds as provided in Section 5.4, and the Owner refuses the payment or the Surety has denied liability, in whole or in part, without further notice the Owner shall be entitled to enforce any remedy available to the Owner.</p>

    <p style="font-size:12px;"> <strong> §7 </strong> If the Surety elects to act under Section 5.1, 5.2 or 5.3, then the responsibilities of the Surety to the Owner shall not be greater than those of the Contractor under the Construction Contract, and the responsibilities of the Owner to the Surety shall not be greater than those of the Owner under the Construction Contract. Subject to the commitment by the Owner to pay the Balance of the Contract Price, the Surety is obligated, without duplication, for</p>
    <ol style="font-size:12px ;padding-left: 40px;">
        <li>the responsibilities of the Contractor for correction of defective work and completion of the Construction Contract;</li>
        <li>additional legal, design professional and delay costs resulting from the Contractor's Default, and resulting from the actions or failure to act of the Surety under Section 5, and </li>
        <li>liquidated darnages, or if no liquidated damages are specified in the Construction Contract, actual damages caused by delayed performance or non-performance of the Contractor.</li>
    </ol>
    <p style="font-size:12px;"> <strong> §8 </strong> If the Surety elects to act under Section 5.1, 5.3 or 5.4, the Surety's liability is limited to the amount of this Bond.</p>
    <p style="font-size:12px;"> <strong> §9 </strong> The Surety shall not be liable to the Owner or others for obligations of the Contractor that are unrelated to the Construction Contract, and the Balance of the Contract Price shall not be reduced or set off on account of any such unrelated obligations. No right of action shall accrue on this Bond to any person or entity other than the Owner or its heirs, executors, administrators, successors and assigns.</p>
    <br>
    <br>
    <hr style="margin-top:24px ;width: 100%">

    <p style="font-size:12px;"> <strong> §10 </strong> The Surety hereby waives notice of any change, including changes of time, to the Construction Contract or to related subcontracts, purchase orders and other obligations.</p>
    <p style="font-size:12px;"> <strong> §11 </strong> Any proceeding, legal or equitable, under this Bond may be instituted in any court of competent jurisdiction in the location in which the work or part of the work is located and shall be instituted within two years after a declaration of Contractor Default or within two years after the Contractor ceased working or within two years after the Surety refuses or fails to perform its obligations under this Bond, whichever occurs first. If the provisions of this Paragraph are void or prohibited by law, the minimum period of limitation available to sureties as a defense in the jurisdiction of the suit shall be applicable. </p>
    <p style="font-size:12px;"> <strong> §12 </strong> Notice to the Surety, the Owner or the Contractor shall be mailed or delivered to the address shown on the page on which their signature appears</p>
    <p style="font-size:12px;"> <strong> §13 </strong> When this Bond has been furnished to comply with a statutory or other legal requirement in the location where the construction was to be performed, any provision in this Bond conflicting with said statutory or legal requirement shall be deemed deleted herefrom and provisions conforming to such statutory or other legal requirement shall be deemed incorporated herein. When so furnished, the intent is that this Bond shall be construed as a statutory bond and not as a common law bond. </p>
    <p style="font-size:12px;"> <strong> §14 Definitions </strong> </p>
    <p style="font-size:12px;"> <strong> §14.1 Balance of the Contract Price. </strong> The total amount payable by the Owner to the Contractor under the Construction Contract after all proper adjustments have been made, including allowance to the Contractor of any amounts received or to be received by the Owner in settlement of insurance or other claims for damages to which the Contractor is entitled, reduced by all valid and proper payments made to or on behalf of the Contractor under the Construction Contract.</p>
    <p style="font-size:12px;"> <strong> §14.2 Construction Contract. </strong> The agreement between the Owner and Contractor identified on the cover page, including all Contract Documents and changes made to the agreement and the Contract Documents.</p>
    <p style="font-size:12px;"> <strong> §14.3 Contractor Default. </strong> Failure of the Contractor, which has not been remedied or waived, to perform or otherwise to comply with a material term of the Construction Contract.</p>
    <p style="font-size:12px;"> <strong> §14.4 Owner Default. </strong> Failure of the Owner, which has not been remedied or waived, to pay the Contractor as required under the Construction Contract or to perform and complete or comply with the other material terms of the Construction Contract.
    <p style="font-size:12px;"> <strong> §14.5 Contract Documents. </strong> All the documents that comprise the agreement between the Owner and Contractor.</p>
    <p style="font-size:12px;"> <strong> §15 </strong> If this Bond is issued for an agreement between a Contractor and subcontractor, the term Contractor in this Bond shall be deemed to be Subcontractor and the term Owner shall be deemed to be Contractor.</p>
    <p style="font-size:12px;"> <strong> §16 </strong> Modification to this bond are as follows: </p>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <div style="font-family: Arial, sans-serif; text-align: left">
        <i style="font-size:12px; margin-top: 3px;">(Space is provided below for additional signatures of added parties, other than those appearing on the cover page. ) </i><br>
    </div>
    <table style="width: 100%; margin-top: 3px;">
        <tr>
            <td style="vertical-align: top; width: 50%;">
                <div class="pb-heading"> <strong> CONTRACTOR AS PRINCIPLE:</strong> </div>
                <div class="pb-heading-text"> <strong>Company: </strong> </div>
                <div class="pb-heading-text"> <strong>Contractor Name: </strong> </div>
                <div class="pb-heading-text" style="margin-top: 25px !important;"> <strong>Signature: </strong> --------------------------------  </div>
                <div style="margin-top: 5px;"> <strong>Name and Title: </strong> </div>
                <div style="margin-top: 5px;"> <strong>Address: </strong> </div>

            </td>
            <td style="vertical-align: top; width: 50%; text-align: left;">
                <div class="pb-heading"> <strong> SURETY:</strong> </div>
                <div style="margin-top: 10px;"> <strong>Company: </strong> </div>
                <div style="margin-top: 5px;"> <strong>Surety Name: </strong> {!! $bond_data->customer->authority->surerty->name!!}</div>
                <div class="pb-heading-text" style="margin-top: 25px !important;"> <strong>Signature: </strong> --------------------------------  </div>
                <div style="margin-top: 5px;"> <strong>Name and Title: </strong> </div>
                <div style="margin-top: 5px;"> <strong>Address: </strong> </div>
            </td>
        </tr>
    </table>
    <hr style="width: 100%">

    <p style="font-size:12px; text-align: right; margin-top: 3px;">Bond No: Bond Number </p>

    <div class="row">
        <div class="left-div" style="font-family: Arial, sans-serif; text-align: center">
            <strong style="font-size:35px; font-weight: 400;text-align: center; margin-bottom: 3px; !important; ">Document A312<sup  style="font-size:18px;">TM</sup>-2010</strong><br>
            <p style="font-size:12px; text-align: center; margin-top: 3px;">Conforms with The American Institute of Architects AIA Document 312 </p>
            <strong style="font-size:20px; float: left; margin-bottom: 5px; !important;"> <i>Payment Bond </i></strong><br>
            <br>
        </div>
    </div>

    <table style="width: 100%; margin-top: 5px;">
        <tr>
            <td style="vertical-align: top; width: 50%;">
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

    <br>

    <table style="width: 100%; margin-top: 3px">
        <tr>
            <td style="vertical-align: top; width: 100%;">
                <div class="pb-heading"> <strong> CONSTRUCTION CONTRACT:</strong> </div>
                <div class="pb-heading-text"> <strong>Date: </strong> Contract Date</div>
                <div class="pb-heading-text"> <strong>Amount: </strong> $Contract Amount</div>
                <div class="pb-heading-text"> <strong>Description: </strong></div>
            </td>
        </tr>
    </table>

    <br>

    <table style="width: 100%; margin-top: 3px">
        <tr>
            <td style="vertical-align: top; width: 100%;">
                <div class="pb-heading"> <strong> Project Description:</strong> </div>
            </td>
        </tr>
    </table>

    <br>

    <table style="width: 100%; margin-top: 3px">
        <tr>
            <td style="vertical-align: top; width: 100%;">
                <div class="pb-heading"> <strong> BOND:</strong> </div>
                <div class="pb-heading-text"> <strong>Date: </strong> Contract Date</div>
                <div class="pb-heading-text"> <i> (Not earlier than Construction Contract Date) </i> </div>
                <div class="pb-heading-text"> <strong>Amount: </strong> $Bond Amount</div>
                <div class="pb-heading-text"> <strong>Modification to this Bond: </strong> <input type="checkbox">None <input type="checkbox">See Section 16 </div>
            </td>
        </tr>
    </table>

    <br>

    <table style="width: 100%; margin-top: 3px;">
        <tr>
            <td style="vertical-align: top; width: 50%;">
                <div class="pb-heading"> <strong> CONTRACTOR AS PRINCIPLE:</strong> </div>
                <div class="pb-heading-text"> <strong>Company: </strong> </div>
                <div class="pb-heading-text"> <strong>Contractor Name: </strong> </div>
                <div class="pb-heading-text" style="margin-top: 25px !important;"> <strong>Signature: </strong> --------------------------------  </div>
                <div style="margin-top: 5px;"> <strong>Name and Title: </strong> </div>

            </td>
            <td style="vertical-align: top; width: 50%; text-align: left;">
                <div class="pb-heading"> <strong> SURETY:</strong> </div>
                <div style="margin-top: 10px;"> <strong>Company: </strong> </div>
                <div style="margin-top: 5px;"> <strong>Surety Name: </strong> {!! $bond_data->customer->authority->surerty->name!!}</div>
                <div class="pb-heading-text" style="margin-top: 25px !important;"> <strong>Signature: </strong> --------------------------------  </div>
                <div style="margin-top: 5px;"> <strong>Name and Title: </strong> </div>
            </td>
        </tr>
    </table>

    <br>

    <div style="font-family: Arial, sans-serif; text-align: left">
        <i style="font-size:12px; margin-top: 1px;">(Any additional signatures appear on the last page of this Performance Bond ) </i><br>
        <i style="font-size:12px; margin-top: 1px;">(FOR INFORMATION ONLY -- Name, address and telephone ) </i>
    </div>

    <br>

    <table style="width: 100%; margin-top: 1px;">
        <tr>
            <td style="vertical-align: top; width: 50%;">
                <div class="pb-heading-text"> <strong> AGENT</strong> or <strong>BROKER:</strong>   </div>
                <div class="pb-heading-text" > Fontana Insurance Solutions,</div>
                <div class="pb-heading-text" > LLC 504 S Niagara St </div>
                <div class="pb-heading-text" > Maquoketa, IA 52060</div>

            </td>
            <td style="vertical-align: top; width: 50%; text-align: left;">
                <div class="pb-heading"> <strong> OWNER'S REPRESENTATIVE:</strong> </div>
                <i style="font-size:12px; margin-top: 3px;">(Architect, Engineer or other party:) </i>

            </td>
        </tr>
    </table>
    <hr style="width: 100%">

    <p style="font-size:12px;"> <strong> § 1 </strong> The Contractor and Surety, jointly and severally, bind themselves, their heirs, executors, administrators, successors and assigns to the Owner to pay for labor, materials and equipment furnished for use in the performance of the Construction Contract, which is incorporated herein by reference, subject to the following terms.</p>
    <p style="font-size:12px;"> <strong> § 2 </strong> If the Contractor promptly makes payment of all sums due to Claimants, and defends, indemnifies and holds harmless the Owner from claims, demands, liens or suits by any person or entity seeking payment for labor, materials or equipment furnished for use in the performance of the Construction Contract, then the Surety and the Contractor shall have no obligation under this Bond.</p>
    <p style="font-size:12px;"> <strong> § 3 </strong> If there is no Owner Default under the Construction Contract, the Surety's obligation to the Owner under this Bond shall arise after the Owner has promptly notified the Contractor and the Surety (at the address described in Section 13) of claims, demands, liens or suits against the Owner or the Owner's property by any person or entity seeking payment for labor, materials or equipment furnished for use in the performance of the Construction Contract and tendered defense of such claims, demands, liens or suits to the Contractor and the Surety.</p>
    <p style="font-size:12px;"> <strong> § 4 </strong> When the Owner has satisfied the conditions in Section 3, the Surety shall promptly and at the Surety's expense defend, indemnify and hold harmless the Owner against a duly tendered claim, demand, lien or suit.</strong> </p>
    <p style="font-size:12px;"> <strong> § 5 </strong> The Surety's obligations to a Claimant under this Bond shall arise after the following:</p>
    <p style="font-size:12px;"> <strong> § 5.1 </strong> Claimants, who do not have a direct contract with the Contractor,</p>
    <ol style="font-size:12px ;padding-left: 40px;">
        <li>have furnished a written notice of non-payment to the Contractor, stating with substantial accuracy the amount claimed and the name of the party to whom the materials were, or equipment was, furnished or supplied or for whom the labor was done or performed, within ninety (90) days after having last performed labor or last furnished materials or equipment included in the Claim, and</li>
        <li>have sent a Claim to the Surety (at the address described in Section 13)</li>
   </ol>

    <p style="font-size:12px;"> <strong> § 5.2 </strong> Claimants, who are employed by or have a direct contract with the Contractor, have sent a Claim to the Surety (at the address described in Section 13).</p>
    <p style="font-size:12px;"> <strong> § 6 </strong> If a notice of non-payment required by Section 5.1.1 is given by the Owner to the Contractor, that is sufficient to satisfy a Claimant's obligation to furnish a written notice of non-payment under Section 5.1.1.</p>
    <p style="font-size:12px;"> <strong> § 7 </strong> When a Claimant has satisfied the conditions of Sections 5.1 or 5.2, whichever is applicable, the Surety shall promptly and at the Surety's expense take the following actions:</p>
    <p style="font-size:12px;"> <strong> § 7.1 </strong> Send an answer to the Claimant, with a copy to the Owner, within sixty (60) days after receipt of the Claim, stating the amounts that are undisputed and the basis for challenging any amounts that are disputed, and</p>
    <p style="font-size:12px;"> <strong> § 7.2 </strong> Pay or arrange for payment of any undisputed amounts.</p>
    <p style="font-size:12px;"> <strong> § 7.3 </strong> The Surety's failure to discharge its obligations under Section 7.1 or Section 7.2 shall not be deemed to constitute a waiver of defenses the Surety or Contractor may have or acquire as to a Claim, except as to undisputed amounts for which the Surety and Claimant have reached agreement If, however, the Surety fails to discharge its obligations under Section 7.1 or Section 7.2, the Surety shall indemnify the Claimant for the reasonable attorney's fees the Claimant incurs thereafter to recover any sums found to be due and owing to the Claimant</p>
    <p style="font-size:12px;"> <strong> § 8 </strong> The Surety's total obligation shall not exceed the amount of this Bond, plus the amount of reasonable attorney's fees provided under Section 7.3. and the amount of this Bond shall be credited for any payments made in good faith by the Surety.</p>
    <p style="font-size:12px;"> <strong> § 9 </strong> Amounts owed by the Owner to the Contractor under the Construction Contract shall be used for the performance of the Construction Contract and to satisfy claims, if any, under any construction performance bond. By the Contractor furnishing and the Owner accepting this Bond, they agree that all funds carned by the Contractor in the performance of the Construction Contract are dedicated to satisfy obligations of the Contractor and Surety under this Bond, subject to the Owner's priority to use the funds for the completion of the work.</p>
    <p style="font-size:12px;"> <strong> § 10 </strong> The Surety shall not be hable to the Owner, Claimants or others for obligations of the Contractor that are unrelated to the Construction Contract. The Owner shall not be liable for the payment of any costs or expenses of any Claimant under this Bond, and shall have under this Bond no obligation to make payments to, or give notice on behalf of, Claimants or otherwise have any obligations to Claimants under this Bond</p>
    <p style="font-size:12px;"> <strong> § 11 </strong> The Surety hereby waives notice of any change, including changes of time, to the Construction Contract or to related subcontracts, purchase orders and other obligations.</p>
    <p style="font-size:12px;"> <strong> § 12 </strong> No suit or action shall be commenced by a Claimant under this Bond other than in a court of competent jurisdiction in the state in which the project that is the subject of the Construction Contract is located or after the expiration of one year from the date (1) on which the Claimant sent a Claim to the Surety pursuant to Section 5.1.2 or 5.2, or (2) on which the last labor or service was performed by anyone or the last materials or equipment were furnished by anyone under the Construction Contract, whichever of (1) or (2) first occurs. If the provisions of this Paragraph are void or prohibited by law, the minimum period of limitation available to sureties as a defense in the jurisdiction of the suit shall be applicable.</p>
    <hr style="width: 100%">
    <p style="font-size:12px;"> <strong> § 13 </strong> Notice and Claims to the Surety, the Owner or the Contractor shall be mailed or delivered to the address shown on the page on which their signature appears. Actual receipt of notice or Claims, however accomplished, shall be sufficient compliance as of the date received.</p>
    <p style="font-size:12px;"> <strong> § 14 </strong> When this Bond has been furnished to comply with a statutory or other legal requirement in the location where the construction was to be performed, any provision in this Bond conflicting with said statutory or legal requirement shall be deemed deleted herefrom and provisions conforming to such statutory or other legal requirement shall be deemed incorporated herein. When so furnished, the intent is that this Bond shall be construed as a statutory bond and not as a common law bond.</p>
    <p style="font-size:12px;"> <strong> § 15 </strong> Upon request by any person or entity appearing to be a potential beneficiary of this Bond, the Contractor and Owner shall promptly furnish a copy of this Bond or shall permit a copy to be made.</p>
    <p style="font-size:12px;"> <strong> § 16 Definitions</strong> </p>
    <p style="font-size:12px;"> <strong> § 16.1 Claim.</strong> A written statement by the Claimant including at a minimum</p>

    <ol style="font-size:12px ;padding-left: 40px;">
            <li>the name of the Claimant,</li>
            <li>the name of the person for whom the labor was done, or materials or equipment fumished,</li>
            <li>a copy of the agreement or purchase order pursuant to which labor, materials or equipment was furnished for use in the performance of the Construction Contract,</li>
            <li>a brief description of the labor, materials or equipment furnished,</li>
            <li>the date on which the Claimant last performed labor or last furnished materials or equipment for use in the performance of the Construction Contract,</li>
            <li>the total amount earned by the Claimant for labor, materials or equipment fumished as of the date of the Claim,</li>
            <li>the total amount of previous payments received by the Claimant, and</li>
            <li>the total amount due and unpaid to the Claimant for labor, materials or equipment furnished as of the date of the Claim.</li>
    </ol>

    <p style="font-size:12px;"> <strong> § 16.2 Claimant </strong> An individual or entity having a direct contract with the Contractor or with a subcontractor of the Contractor to furnish labor, materials or equipment for use in the performance of the Construction Contract. The term Claimant also includes any individual or entity that has rightfully asserted a claim under an applicable mechanic's lien or similar statute against the real property upon which the Project is located. The intent of this Bond shall be to include without limitation in the terms "labor, materials or equipment" that part of water, gas, power, light, heat, oil, gasoline, telephone service or rental equipment used in the Construction Contract, architectural and engineering services required for performance of the work of the Contractor and the Contractor's subcontractors, and all other items for which a mechanic's lien may be asserted in the jurisdiction where the labor, materials or equipment were furnished.</p>
    <p style="font-size:12px;"> <strong> § 16.3 Construction Contract. </strong> The agreement between the Owner and Contractor identified on the cover page, including all Contract Documents and all changes made to the agreement and the Contract Documents.</p>
    <p style="font-size:12px;"> <strong> § 16.4 Owner Default.</strong> Failure of the Owner, which has not been remedied or waived, to pay the Contractor as required under the Construction Contract or to perform and complete or comply with the other material terms of the Construction Contract</p>
    <p style="font-size:12px;"> <strong> § 16.5 Contract Documents.</strong> All the documents that comprise the agreement between the Owner and Contractor</p>
    <p style="font-size:12px;"> <strong> § 17 </strong> If this Bond is issued for an agreement between a Contractor and subcontractor, the term Contractor in this Bond shall be deemed to be Subcontractor and the term Owner shall be deemed to be Contractor.</p>
    <p style="font-size:12px;"> <strong> § 18 </strong> Modifications to this bond are as follows: </p>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <div style="font-family: Arial, sans-serif; text-align: left">
        <i style="font-size:12px; margin-top: 3px;">(Space is provided below for additional signatures of added parties, other than those appearing on the cover page. ) </i><br>
    </div>
    <table style="width: 100%; margin-top: 3px;">
        <tr>
            <td style="vertical-align: top; width: 50%;">
                <div class="pb-heading"> <strong> CONTRACTOR AS PRINCIPLE:</strong> </div>
                <div class="pb-heading-text"> <strong>Company: </strong> </div>
                <div class="pb-heading-text"> <strong>Contractor Name: </strong> </div>
                <div class="pb-heading-text" style="margin-top: 25px !important;"> <strong>Signature: </strong> --------------------------------  </div>
                <div style="margin-top: 5px;"> <strong>Name and Title: </strong> </div>
                <div style="margin-top: 5px;"> <strong>Address: </strong> </div>

            </td>
            <td style="vertical-align: top; width: 50%; text-align: left;">
                <div class="pb-heading"> <strong> SURETY:</strong> </div>
                <div style="margin-top: 10px;"> <strong>Company: </strong> </div>
                <div style="margin-top: 5px;"> <strong>Surety Name: </strong> {!! $bond_data->customer->authority->surerty->name!!}</div>
                <div class="pb-heading-text" style="margin-top: 25px !important;"> <strong>Signature: </strong> --------------------------------  </div>
                <div style="margin-top: 5px;"> <strong>Name and Title: </strong> </div>
                <div style="margin-top: 5px;"> <strong>Address: </strong> </div>
            </td>
        </tr>
    </table>
    <hr style="width: 100%">

    <table style="width: 100%; margin-top: 3px;">
        <tr>
            <!-- Centered text -->
            <td style="vertical-align: middle; width: 80%; position: relative; text-align: center;">
                <div style="font-size: 12px;">
                    <strong>This Power of Attorney limits the acts of those named herein, and they have no authority</strong><br>
                    <strong>to bind the Company except in the manner and to the extent herein stated.</strong>
                </div>
            </td>
        </tr>
    </table>

    <table style="width: 100%;">
        <tr>
            <td style="vertical-align: top; width: 30%; position: relative;">
                <div style="width: 110px; height: 100px; padding-bottom: 40px;">
                    <img src="{!! public_path('/images/liberty_image.png') !!}" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                </div>
            </td>

            <td style="vertical-align: top; width: 40%;">
                <div style="margin-top: 10px; padding-left: 8px;"> Liberty Mutual Insurance Company </div>
                <div style="margin-top: 2px;"> The Ohio Casualty Insurance Company </div>
                <div style="margin-top: 2px; padding-left: 8px;"> West American Insurance Company </div>
                <br>
                <div style="margin-top: 5px;"><strong style="font-size: 20px;">POWER OF ATTORNEY</strong></div>
            </td>

            <td style="vertical-align: top; width: 30%;">
                <p style="float: right">
                    <span>Certificate No: </span>
                    <span style="border-bottom: 1px solid black; min-width: 100px;">SAMPLE </span>
                </p>
{{--                <p style="font-size: 12px; padding-top: 30px; text-align: right; margin: 0;">Certificate No: <span class="line-underline" style="border-bottom: 1px solid black; width: 20%; display: inline-block;">SAMPLE</span></p>--}}
            </td>
        </tr>
    </table>
    <div style="display: flex; align-items: center; font-size: 11px;">
        <p style="margin: 0; flex: 1;">
            <strong>KNOWN ALL PERSONS BY THESE PRESENTS:</strong> That The Ohio Casualty Insurance Company is a corporation duly organized under the laws of the State of New Hampshire, that Liberty Mutual Insurance Company is a corporation duly organized under the laws of the State of Massachusetts, and West American Insurance Company is a corporation duly organized under the laws of the State of Indiana (herein collectively called the “Companies”), pursuant to and by authority herein set forth, does hereby name, constitute and appoint
            <span class="line-underline" style="border-bottom: 1px solid black; width: 13%; display: inline-block;">&nbsp;</span>
        </p>
        <span style="border-bottom: 1px solid black; width: 50%;"></span>
    </div>

    <p style="width: 100%; display: table;">
        <span style="display: table-cell; border-bottom: 1px solid black; width: 100%;"></span>
    </p>
    <p style="width: 100%; display: table;">
        <span style="display: table-cell; border-bottom: 1px solid black; width: 100%;"></span>
    </p>
    <p style="width: 100%; display: table;">
        <span style="display: table-cell; border-bottom: 1px solid black; width: 100%;"></span>
    </p>
    <p style="width: 100%; display: table;">
        <span style="display: table-cell; border-bottom: 1px solid black; width: 100%;"></span>
    </p>

    <p style="font-size:11px;">All of the city of <span class="line-underline" style="border-bottom: 1px solid black; width: 20%; display: inline-block;">&nbsp;</span> state of<span class="line-underline" style="border-bottom: 1px solid black; width: 20%; display: inline-block;">&nbsp;</span>each individually if there be more than one named, its true and lawful attorney-in-fact to make, execute, seal, acknowledge and deliver, for and on its behalf as surety and as its act and deed, any and all undertakings, bonds, recognizances and other surety obligations, in pursuance of these presents and shall be as binding upon the Companies as if they have been duly signed by the president and attested by the secretary of the Companies in their own proper persons.</p>
    <p style="font-size:11px;"> <strong>IN WITNESS WHERE OF:</strong> this Power of Attorney has been subscribed by an authorized officer or official of the Companies and the corporate seals of the Companies have been affixed thereto this<span class="line-underline" style="border-bottom: 1px solid black; width: 10%; display: inline-block;">&nbsp;</span> day of<span class="line-underline" style="border-bottom: 1px solid black; width: 15%; display: inline-block;">&nbsp;</span>,<span class="line-underline" style="border-bottom: 1px solid black; width: 10%; display: inline-block;">&nbsp;</span> </p>

    <table style="width: 100%;">
        <tr>
            <td style="vertical-align: top; width: 60%; position: relative;">
                <div style="width: 100%; height: 100px; padding-bottom: 30px;">
                    <img src="{!! public_path('/images/witness.png') !!}" style="max-width: 100%; max-height: 100%; object-fit: contain; float: right;">
                    <p style="font-size:11px; padding-top: 90px"> State of PENNSYLVANIA ss    <br><span> County of MONTGOMERY</span></p>
                </div>

            </td>

            <td style="vertical-align: top;float: left; width: 40%;">
                <div style="margin-top: 1px;"> Liberty Mutual Insurance Company </div>
                <div style="margin-top: 1px;"> The Ohio Casualty Insurance Company </div>
                <div style="margin-top: 1px;"> West American Insurance Company </div>
                <div style="margin-top: 25px;"> <strong> By:</strong><span class="line-underline" style="border-bottom: 1px solid black; width: 100%; display: inline-block;">&nbsp;</span></div><span style="padding-left: 20px" >Teresa Pastella, Notary Public</span>
            </td>
        </tr>
    </table>
    <p style="font-size:11px;"> On this<span class="line-underline" style="border-bottom: 1px solid black; width: 10%; display: inline-block;">&nbsp;</span>day of<span class="line-underline" style="border-bottom: 1px solid black; width: 15%; display: inline-block;">&nbsp;</span>,<span class="line-underline" style="border-bottom: 1px solid black; width: 10%; display: inline-block;">&nbsp;</span>before me personally appeared David M. Carey, who acknowledged himself to be the Assistant Secretary of Liberty Mutual Insurance Company, The Ohio Casualty Company, and West American Insurance Company, and that he, as such, being authorized so to do, execute the foregoing instrument for the purposes therein contained by signing on behalf of the corporations by himself as a duly authorized officer. </p>
    <p style="font-size:11px;"> <strong>IN WITNESS WHEREOF,</strong> I have hereunto subscribed my name and affixed my notarial seal at King of Prussia, Pennsylvania, on the day and year first above written.</p>
    <table style="width: 100%;">
        <tr>
            <td style="vertical-align: top; width: 60%; position: relative;">
                <div style="width: 100%; height: 100px;">
                    <img src="{!! public_path('/images/witness2.png') !!}" style="max-width: 100%; max-height: 100%; object-fit: contain; float: right;">
                </div>
            </td>
            <td style="vertical-align: top;float: left; width: 40%;">
                <div style="margin-top: 35px;"> <strong> By:</strong><span class="line-underline" style="border-bottom: 1px solid black; width: 100%; display: inline-block;">&nbsp;</span></div><span style="padding-left: 20px" >Teresa Pastella, Notary Public</span>
            </td>
        </tr>
    </table>

    <p style="font-size:11px;"> This Power of Attorney is made and executed pursuant to and by authority of the following By-laws and Authorizations of The Ohio Casualty Insurance Company, Liberty Mutual Insurance Company, and West American Insurance Company which resolutions are now in full force and effect reading as follows:</p>
    <p style="font-size:11px;"> <strong> ARTICLE IV – OFFICERS:</strong> Section 12.Power of Attorney.</p>
    <p style="font-size:11px; padding-left: 30px"> Any officer or other official of the Corporation authorized for that purpose in writing by the Chairman or the President, and subject to such limitation as the Chairman or the President may prescribe, shall appoint such attorneys-in-fact, as may be necessary to act in behalf of the Corporation to make, execute, seal, acknowledge and deliver as surety any and all undertakings, bonds, recognizances and other surety obligations. Such attorneys-in-fact, subject to the limitations set forth in their respective powers of attorney, shall have full power to bind the Corporation by their signature and execution of any such instruments and to attach thereto the seal of the Corporation. When so executed, such instruments shall be as binding as if signed by the President and attested to by the Secretary. Any power or authority granted to any representative or attorney-in-fact under the provisions of this article may be revoked at any time by the Board, the Chairman, the President or by the officer or officers granting such power or authority.</p>
    <br>
    <br>
    <p style="font-size:11px;"> <strong>ARTICLE XIII – Execution of Contracts:,</strong> Section 5. Surety Bonds and Undertakings. </p>
    <p style="font-size:11px;padding-left: 30px"> Any officer of the Company authorized for that purpose in writing by the chairman or the president, and subject to such limitations as the chairman or the president may prescribe, shall appoint such attorneys-in-fact, as may be necessary to act in behalf of the Company to make, execute, seal, acknowledge and deliver as surety any and all undertakings, bonds, recognizances and other surety obligations. Such attorneys-in-fact subject to the limitations set forth in their respective powers of attorney, shall have full power to bind the Company by their signature and execution of any such instruments and to attach thereto the seal of the Company. When so executed such instruments shall be as binding as if signed by the president and attested by the secretary. </p>
    <p style="font-size:11px;"> <strong> Certificate of Designation-</strong> The President of the Company, acting pursuant to the Bylaws of the Company, authorizes David M. Carey, Assistant Secretary to appoint such attorneys-in- fact as may be necessary to act on behalf of the Company to make, execute, seal, acknowledge and deliver as surety any and all undertakings, bonds, recognizances and other surety obligations.</p>
    <p style="font-size:11px;"> <strong>Authorization-</strong> By unanimous consent of the Company's Board of Directors, the Company consents that facsimile or mechanically reproduced signature of any assistant secretary of the Company, wherever appearing upon a certified copy of any power of attorney issued by the Company in connection with surety bonds, shall be valid and binding upon the Company with the same force and effect as though manually affixed.</p>
    <p style="font-size:11px;"> I, Renee C. Llewellyn, the undersigned, Assistant Secretary, The Ohio Casualty Insurance Company, Liberty Mutual Insurance Company, and West American Insurance Company do hereby certify that the original power of attorney of which the foregoing is a full, true and correct copy of the Power of Attorney executed by said Companies, is in full force and effect and has not been revoked. </p>
    <p style="font-size:11px;"> <strong>IN TESTIMONY WHEREOF-</strong> I have hereunto set my hand and affixed the seals of said Companies this</strong><span class="line-underline" style=" width: 10%; display: inline-block;">&nbsp;</span>day of<span class="line-underline" style=" width: 12%; display: inline-block;">&nbsp;</span>,<span class="line-underline" style=" width: 10%; display: inline-block;">&nbsp;</span></p>

    <table style="width: 100%;">
        <tr>
            <td style="vertical-align: top; width: 60%; position: relative;">
                <div style="width: 100%; height: 100px; padding-bottom: 40px;">
                    <img src="{!! public_path('/images/witness.png') !!}" style="max-width: 100%; max-height: 100%; object-fit: contain; float: right;">
                </div>
            </td>


            <td style="vertical-align: top;float: left; width: 40%;">
                <div style="margin-top: 25px;"> <strong> By:</strong><span class="line-underline" style="border-bottom: 1px solid black; width: 100%; display: inline-block;">&nbsp;</span></div><span style="padding-left: 20px" >Renee C. Llewellyn, Assistant Secretary</span>
            </td>
        </tr>
    </table>

</body>

{{--</body>--}}
</html>
