<x-app-layout>
    <x-slot name="title">
        {{ __('Edit Customer') }}
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
        <form action="{{route('customer.update')}}" method="POST">
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
                                    <input type="hidden" class="form-control" placeholder="Name" id="name" name="cust_id" value="{!! $customer->id !!}">
                                    <input type="hidden" class="form-control" placeholder="Name" id="name" name="user_id" value="{!! $customer->user_id !!}">

                                    <div class="col-md-4 mb-3">
                                        <label for="name" class="form-label">Account Name <span class="req text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Name" id="name" name="name" value="{!! $customer->user->name !!}">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="corporation_type" class="form-label">Corporation Type <span class="req text-danger">*</span></label>
                                        <select  placeholder="Select Corporation Type" class="form-select select2selector" id="corporation_type" name="corporation_type">
                                            <option value="0"> Select Corporation Type</option>
                                            @foreach(corporation_types() as $key => $position)
                                                <option value="{{$key}}" @selected($customer->corporation_type == $key)>{{$position}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="primary_contact" class="form-label">Primary Contact <span class="req text-danger">*</span></label>
                                        <input type="text" class="form-control" id="primary_contact" name="primary_contact" value="{!! $customer->primary_contact !!}" placeholder="Primary Contact"/>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="phone" class="form-label">Phone <span class="req text-danger">*</span></label>
                                        <input type="text" class="form-control" id="phone" name="phone" value="{!! $customer->phone !!}" placeholder="Phone"/>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="email" class="form-label">Email <span class="req text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email" value="{!! $customer->user->email !!}" placeholder="Email"/>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="size" class="form-label">Average Project Size <span class="req text-danger">*</span></label>
                                        <input type="number" class="form-control" id="size" name="average_size" value="{!! $customer->average_size !!}" placeholder="Average Project Size"/>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="largest_size" class="form-label">Largest Project Size <span class="req text-danger">*</span></label>
                                        <input type="number" class="form-control" id="largest_size" name="largest_size" value="{!! $customer->largest_size !!}" placeholder="Largest Project Size"/>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="backlog" class="form-label">Largest Backlog <span class="req text-danger">*</span></label>
                                        <input type="number" class="form-control" id="backlog" name="backlog" value="{!! $customer->backlog !!}" placeholder="Largest Backlog"/>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="name" class="form-label">State<span class="req text-danger">*</span></label>
                                        <select target='select[name="city_id"]' placeholder="Select City"
                                                url="{!! route('state.get-cities') !!}" params="province_id" name="province_id"
                                                class="form-select changeInputMws input_province_id select2selector">
                                            <option value="0">Select State</option>
                                            @foreach($provinces as $row)
                                                <option value="{!! $row->id !!}" @selected($customer->state_id == $row->id)>{!! $row->name !!}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="city_id" class="form-label">City<span class="req text-danger">*</span></label>
                                        <select name="city_id" class="form-select city_id_selector select2selector">
                                            <option value="0">Select City</option>
                                            @foreach($cities as $row)
                                                <option value="{!! $row->id !!}" @selected($customer->city_id == $row->id)>{!! $row->name !!}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="zip" class="form-label">Zip <span class="req text-danger">*</span></label>
                                        <input type="text" class="form-control" id="zip" name="zip" placeholder="Zip" value="{!! $customer->zip !!}"/>
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
                                        <textarea class="form-control" id="address" name="address" placeholder="Address" rows="1">{!! $customer->address !!}</textarea>
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
                                                <option value="{!! $insurer['id'] !!}" @selected($authority->surerty->id == $insurer['id'])> {!! $insurer->name !!}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                </div>
                                <div class="suretyDetails">
                                    {{--                                    <x-surety-form  />--}}
                                    @if(isset($authority->surerty->id))

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="rating" class="form-label">AM Best Rating<span class="req text-danger">*</span></label>
                                                <input type="text" class="form-control" id="rating" name="rating" placeholder="AM Best Rating" value="{{$authority->surerty->am_best_rating}}"/>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="treasury_list" class="form-label">Treasury Listed <span class="req text-danger">*</span></label>
                                                <input type="text" class="form-control" id="treasury_list" name="treasury_list" placeholder="Treasury Listed" value="{{$authority->surerty->treasury_list}}"/>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="underwriter_name" class="form-label">Underwriter Name<span class="req text-danger">*</span></label>
                                                <input type="text" class="form-control" id="underwriter_name" name="underwriter_name" placeholder="Underwriter Name"value="{{$authority->surerty->cbu_name}}"/>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="underwriter_phone" class="form-label">Underwriter Phone<span class="req text-danger">*</span></label>
                                                <input type="text" class="form-control" id="underwriter_phone" name="underwriter_phone" placeholder="Underwriter Phone" value="{{$authority->surerty->cbu_phone}}"/>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="underwriter_email" class="form-label">Underwriter Email<span class="req text-danger">*</span></label>
                                                <input type="text" class="form-control" id="underwriter_email" name="underwriter_email" placeholder="Underwriter Email" value="{{$authority->surerty->cbu_email}}"/>
                                            </div>
                                        </div>
                                    @endif
                                    {{--                                    <x-surety-form  />--}}

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel-heading">
                    <h6 class="accordion-header mt-0" id="headingFive" style="background-color: #edf7fd;padding:15px">
                        <strong>Questions </strong>
                    </h6>
                </div>
                <div class="panel-body">
                    <div class="accordion-body">
                        <div class="card mb-4 mt-2 question-row" data-index="{{ $key }}">
                            <div class="card-body">
                                <div class="row" id="questions-container">
                                    @foreach($questions as $key => $item)
                                        <div class="row mb-3" id="question-row-{{ $key }}">
                                            <div class="col-md-11">
                                                <label for="questions_{{ $key }}" class="form-label">Question <span class="req text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="Questions" id="questions_{{ $key }}" name="questions[{{ $key }}]" value="{{ $item->question }}">
                                                <input type="hidden" name="question_id[{{ $key }}]" value="{{ $item->id }}">
                                            </div>
                                            <div class="col-md-1 d-flex align-items-center" style="margin-top: 24px">
                                                <button type="button" class="btn btn-danger btn-sm remove-question" data-index="{{ $key }}">Remove</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button class="btn btn-success" type="button" id="add-question">+ Add More</button>
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
                                    <input type="hidden" class="form-control" id="start_date" name="authority_id" value="{{$authority->id}}" />

                                    <div class="col-md-4 mb-3">
                                        <label for="start_date" class="form-label ">Effective Date <span class="req text-danger">*</span> </label>
                                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{$authority->start_date}}" placeholder="Expiration Date"/>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="exp_date" class="form-label">Expiration Date Date <span class="req text-danger">*</span></label>
                                        <input type="date" class="form-control" id="exp_date" name="exp_date" placeholder="Expiration Date" value="{{$authority->expiry_date}}"/>
                                    </div>
                                    <div class="col-md-4 mb-3">

                                        <label for="territory" class="form-label">Territory <span class="req text-danger">*</span></label>
                                        <select name="territory" class="form-select select2selector">
                                            <option value="0">Select State</option>
                                            @foreach($provinces as $row)
                                                <option value="{!! $row->id !!}" @selected($authority->territory == $row->id)>{!! $row->name !!}</option>
                                            @endforeach
                                        </select>

                                        {{--                                    <input type="number" class="form-control" id="territory" name="territory" placeholder="Territory"/>--}}
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Single Project Limit <span class="req text-danger">*</span></label>
                                        <input type="number" class="form-control" placeholder="Single Job Limit" name="single_limt" value="{{$authority->single_job_limit}}"/>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="number" class="form-label">Aggregate Limit <span class="req text-danger">*</span></label>
                                        <input type="number" class="form-control" id="number" name="aggr_limt" placeholder="Aggregate Limit" value="{{$authority->aggregate_limit}}"/>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="design_build" class="form-label">Design Build<span class="req text-danger">*</span></label>
                                        <select name="design_build" class="form-select select2selector">
                                            <option value="1" @selected($authority->design_build == 1)>Yes</option>
                                            <option value="0" @selected($authority->design_build == 0)>No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="name" class="form-label">Job Duration (Years) <span class="req text-danger">*</span></label>
                                        <input type="number" class="form-control" placeholder="Job Duration"  name="job_dur" value="{{$authority->job_duration}}"/>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="warranty_dur" class="form-label">Warranty Period (Years) <span class="req text-danger">*</span></label>
                                        <input type="number" class="form-control" id="warranty_dur" name="warranty_dur" placeholder="Warranty Period" value="{{$authority->warranty_duration}}"/>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="Hazmat" class="form-label">Hazmat/Asbestos<span class="req text-danger">*</span></label>
                                        <select name="hazmat" class="form-select select2selector" id="Hazmat">
                                            <option value="1" @selected($authority->hazmat == 1) >Yes</option>
                                            <option value="0" @selected($authority->hazmat == 0) >No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Bid Spread % <span class="req text-danger">*</span></label>
                                        <input type="number" class="form-control" placeholder="Minimum Bid" id="name" name="minim_bid" value="{!! $authority->minimum_bid !!}">
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
<script>
    $(document).ready(function(){
       var surety_val   =   $('.ajax_load_select').val();
        // alert(surety_val);
    });
</script>

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
<script>
    $(document).ready(function () {
        let questionIndex = {{ count($questions) }}; // Initialize index from the count of existing questions

        // Add a new question field dynamically
        $('#add-question').click(function () {
            addQuestionField('', questionIndex);
            questionIndex++;
        });

        // Function to append a new question field
        function addQuestionField(value, index) {
            const newQuestionField = `
                <div class="row mb-3" id="question-row-${index}">
                    <div class="col-md-11">
                        <label for="questions_${index}" class="form-label">Question <span class="req text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Questions" id="questions_${index}" name="questions[${index}]" value="${value}">
                    </div>
                    <div class="col-md-1 d-flex align-items-center" style="margin-top: 24px">
                        <button type="button" class="btn btn-danger btn-sm remove-question" data-index="${index}">Remove</button>
                    </div>
                </div>
            `;
            $('#questions-container').append(newQuestionField);
        }

        // Remove a question field dynamically
        $(document).on('click', '.remove-question', function () {
            const index = $(this).data('index');
            $(`#question-row-${index}`).remove();
        });
    });
</script>

