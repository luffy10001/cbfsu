<x-app-layout>
    <x-slot name="title">
        {{ __('Add Customer') }}
    </x-slot>
    <style>


        .blockquote-footer {
            margin-bottom: 0.5rem;
        }
        .blockquote > :last-child {
            font-size: 14px;
        }
        .kbw-signature { width: 100%; height: 200px;}
        #sig canvas{
            width: 100% !important;
            height: auto;
        }
    </style>
    <div class="container">
        <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-1" type="button" class="btn btn-success btn-circle"><i class="circle" aria-hidden="true"></i></a>
                    <p>General Grant Information</p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-2" type="button" class="btn btn-default btn-circle"><i class="circle" aria-hidden="true"></i></a>
                    <p>Indemnity</p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-3" type="button" class="btn btn-default btn-circle"><i class="circle" aria-hidden="true"></i></a>
                    <p>Surety Details</p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-4" type="button" class="btn btn-default btn-circle"><i class="circle" aria-hidden="true"></i></a>
                    <p>Line of Authority</p>
                </div>
            </div>
        </div>
        <form action="{{route('customer.store')}}" method="POST">
            @csrf
            <div class="panel panel-primary setup-content" id="step-1">
                <div class="panel-heading">
                    <hr style="margin-top: 0;">
                    <h6 class="accordion-header mt-0" id="headingFive" style="background-color: #edf7fd;padding:15px">
                        <strong>General Grant Information </strong>
                    </h6>
                </div>
                <div class="panel-body">
                    <div class="accordion-body">
                        <div class="card mb-4 mt-2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="name" class="form-label">Account Name <span class="req text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Name" id="name" name="name">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="corporation_type" class="form-label">Corporation Type <span class="req text-danger">*</span></label>
                                        <select  placeholder="Select Corporation Type" class="form-select select2selector" id="corporation_type" name="corporation_type">
                                            <option value="0"> Select Corporation Type</option>
                                            @foreach(corporation_types() as $key => $position)
                                                <option value="{{$key}}">{{$position}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="primary_contact" class="form-label">Primary Contact <span class="req text-danger">*</span></label>
                                        <input type="text" class="form-control" id="primary_contact" name="primary_contact" placeholder="Primary Contact"/>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="phone" class="form-label">Phone <span class="req text-danger">*</span></label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone"/>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="email" class="form-label">Email <span class="req text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"/>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="size" class="form-label">Average Project Size <span class="req text-danger">*</span></label>
                                        <input type="number" class="form-control" id="size" name="average_size" placeholder="Average Project Size"/>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="largest_size" class="form-label">Largest Project Size <span class="req text-danger">*</span></label>
                                        <input type="number" class="form-control" id="largest_size" name="largest_size" placeholder="Largest Project Size"/>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="backlog" class="form-label">Largest Backlog <span class="req text-danger">*</span></label>
                                        <input type="number" class="form-control" id="backlog" name="backlog" placeholder="Largest Backlog"/>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="name" class="form-label">Sate<span class="req text-danger">*</span></label>
                                        <select target='select[name="city_id"]' placeholder="Select City"
                                                url="{!! route('state.get-cities') !!}" params="province_id" name="province_id"
                                                class="form-select changeInputMws input_province_id select2selector">
                                            <option value="0">Select State</option>
                                            @foreach($provinces as $row)
                                                <option value="{!! $row->id !!}">{!! $row->name !!}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="city_id" class="form-label">City<span class="req text-danger">*</span></label>
                                        <select name="city_id" class="form-select city_id_selector select2selector">
                                            <option value="0">Select City</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="zip" class="form-label">Zip <span class="req text-danger">*</span></label>
                                        <input type="text" class="form-control" id="zip" name="zip" placeholder="Zip"/>
                                    </div>
                                    {{--                                <div class="col-md-4 mb-3">--}}
                                    {{--                                    <label for="positions" class="form-label">Positions Title*</label>--}}
                                    {{--                                    <select  placeholder="Select a Position" class="form-select select2selector" id="positions" name="positions">--}}
                                    {{--                                        <option value="0"> Select a positions</option>--}}
                                    {{--                                        @foreach(positions() as $key => $position)--}}
                                    {{--                                            <option value="{{$key}}">{{$position}}</option>--}}
                                    {{--                                        @endforeach--}}
                                    {{--                                    </select>--}}
                                    {{--                                </div>--}}
                                    {{--                                <div class="col-md-4 mb-3">--}}
                                    {{--                                    <label for="agent_id" class="form-label">Service Agent Name*</label>--}}
                                    {{--                                    <select  placeholder="Select a Agent" class="form-select select2selector" id="agent_id" name="agent_id">--}}
                                    {{--                                        <option value="0"> Select a Agent</option>--}}
                                    {{--                                        @foreach($agents as $agent)--}}
                                    {{--                                            <option value="{{$agent->id}}"> {{ $agent->name }} </option>--}}
                                    {{--                                        @endforeach--}}
                                    {{--                                    </select>--}}
                                    {{--                                </div>--}}
                                    <div class="col-md-4 mb-0 " toggle="password-parent" style="position: relative">
                                        <label class=" control-label">Password <span class="req text-danger">*</span></label>
                                        <input id="password-field" type="password" class="form-control" name="password">
                                        <span class="fa fa-fw fa-eye-slash field-icon toggle-password"> </span>
                                    </div>

                                    <div class="col-md-4 mb-3 " toggle="password-parent" style="position: relative">
                                        <label for="password_confirmation" class="form-label">Confirm Password <span class="req text-danger">*</span></label>
                                        <input id="password_confirmation" type="password" class="form-control password"
                                               name="password_confirmation">
                                        <span class="fa fa-fw fa-eye-slash field-icon toggle-password"> </span>
                                    </div>
                                    <div class="col-md-8 mb-3">
                                        <label for="address" class="form-label">Address <span class="req text-danger">*</span></label>
                                        <textarea class="form-control" id="address" name="address" placeholder="Address" rows="1"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('layouts.stepform.footer',['last' => false])
                </div>
            </div>
            <div class="panel panel-primary setup-content" id="step-2">
                <div class="panel-heading">
                    <hr style="margin-top: 0;">
                    <h6 class="accordion-header mt-0" id="headingFive" style="background-color: #edf7fd;padding:15px">
                        <strong>Indemnity </strong>
                    </h6>
                </div>
                <div class="panel-body">
                    <div class="accordion-body">
                        <div class="card mb-4 mt-2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input id="Personal" type="radio" class="" name="status" value="personal" checked>
                                        <label for="Personal" class="btn-radio "> Corporate and Personal </label><br>
                                        <input id="Corporate" type="radio" class=" btn-radio" name="status" value="corporate" >
                                        <label class="" for="Corporate"> Corporate Only </label>
                                    </div>
                                    <div class="row personal hidden">
                                        <div class="col-12 mt-2 mb-2">
                                            <label for="personal_indemnitor" class="form-label "> <strong>Personal Indemnitor(s)<span class="req text-danger">*</span></strong></label>
                                            <textarea name="personal_indemnitor" class="form-control" rows="3">  </textarea>
                                        </div>
                                    </div>
                                    <div class="row corporate hidden">
                                        <div class="col-12 mt-2 mb-2">
                                            <label for="corporate_indemnitor" class="form-label "> <strong> Corporate Indemnitor(s)<span class="req text-danger">*</span></strong></label>
                                            <textarea name="corporate_indemnitor" class="form-control" rows="3">  </textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    @include('layouts.stepform.footer',['last' => false])
                </div>
            </div>
            <div class="panel panel-primary setup-content" id="step-3">
                <div class="panel-heading">
                    <hr style="margin-top: 0;">
                    <h6 class="accordion-header mt-0" id="headingFive" style="background-color: #edf7fd;padding:15px">
                        <strong>Surety </strong>
                    </h6>
                </div>
                <div class="panel-body">
                    <div class="accordion-body">
                        <div class="card mb-4 mt-2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label ">Surety Name <span class="req text-danger">*</span> </label>
                                        <select  params="surety_id"
                                                 append="0"
                                                 url="{!! route('surety_details.append') !!}"
                                                 method="post"
                                                 target_div="suretyDetails"
                                                 class="select2selector input_surety_id form-select js-example-basic-single ajax_load_select"
                                                 name="insurer">
                                            <option value=""> Surety Name</option>
                                            @foreach($insurers as $insurer)
                                                <option value="{!! $insurer['id'] !!}"> {!! $insurer->name !!}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                        {{--                                    <x-surety-form  />--}}
                                    </div>
                                    <div class="suretyDetails">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    @include('layouts.stepform.footer',['last' => false])
                </div>

            <div class="panel panel-primary setup-content" id="step-4">
                <div class="panel-heading">
                    <hr style="margin-top: 0;">
                    <h6 class="accordion-header mt-0" id="headingFive" style="background-color: #edf7fd;padding:15px">
                        <strong>Line of Authority </strong>
                    </h6>
                </div>
                <div class="panel-body">
                    <div class="accordion-body">
                        <div class="card mb-4 mt-2">
                            <div class="card-body">
                                <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="start_date" class="form-label ">Effective Date <span class="req text-danger">*</span> </label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" placeholder="Expiration Date"/>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="exp_date" class="form-label">Expiration Date Date <span class="req text-danger">*</span></label>
                                    <input type="date" class="form-control" id="exp_date" name="exp_date" placeholder="Expiration Date"/>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="territory" class="form-label">Territory <span class="req text-danger">*</span></label>
                                    <input type="number" class="form-control" id="territory" name="territory" placeholder="Territory"/>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Single Project Limit <span class="req text-danger">*</span></label>
                                    <input type="number" class="form-control" placeholder="Single Job Limit" name="single_lim">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="number" class="form-label">Aggregate Limit <span class="req text-danger">*</span></label>
                                    <input type="number" class="form-control" id="number" name="aggr_lim" placeholder="Aggregate Limit"/>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="design_build" class="form-label">Design Build<span class="req text-danger">*</span></label>
                                    <select name="design_build" class="form-select select2selector">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="name" class="form-label">Job Duration (Years) <span class="req text-danger">*</span></label>
                                    <input type="number" class="form-control" placeholder="Job Duration"  name="job_dur">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="email" class="form-label">Warranty Period (years) <span class="req text-danger">*</span></label>
                                    <input type="number" class="form-control" id="email" name="warranty_dur" placeholder="Warranty Period"/>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="Hazmat" class="form-label">Hazmat/Asbestos<span class="req text-danger">*</span></label>
                                    <select name="hazmat" class="form-select select2selector" id="Hazmat">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Bid Spread % <span class="req text-danger">*</span></label>
                                    <input type="number" class="form-control" placeholder="Minimum Bid" id="name" name="minim_bid">
                                </div>
                                </div>
                        </div>
                    </div>
                </div>
                @include('layouts.stepform.footer',['last' => true])
            </div>
        </div>
        </form>
    </div>

</x-app-layout>
<script src="{!! asset('assets/js/jquery-ui.min.js') !!}?v=11"></script>
<script src="{!! asset('assets/js/jquery.signature.js') !!}?v=11"></script>
<script type="module">
    $(document).find('.select2selector').select2();
    $(document).ready(function() {
        MultiStepFormJs(); // Include
        $('input[name="status"]').change(function() {
            var selectedValue = $('input[name="status"]:checked').val();
            if (selectedValue == 'personal') {
                $(document).find('.personal').removeClass('hidden');
                $(document).find('.corporate').addClass('hidden');
            }else if (selectedValue === 'corporate') {
                $(document).find('.personal').addClass('hidden');
                $(document).find('.corporate').removeClass('hidden');
            }
        });

        // Initial check to see which radio button is selected when the page loads
        var selectedValue = $('input[name="status"]:checked').val();
        if (selectedValue) {
            if (selectedValue === 'personal') {
                $(document).find('.personal').removeClass('hidden');
                $(document).find('.corporate').addClass('hidden');
            } else if (selectedValue === 'corporate') {
                $(document).find('.personal').addClass('hidden');
                $(document).find('.corporate').removeClass('hidden');
            }
        }
    });

</script>

