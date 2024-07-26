<x-custom-modal-component>
    <x-slot name="title">
        {{ __('Edit Line Of Authority') }}
    </x-slot>

    <x-slot name="body">
        <style>
            .field-icon {
                top: 40px;
                right: 30px;
                position: absolute;
                z-index: 2;
                cursor: pointer;
            }

            .container {
                padding-top: 50px;
                margin: auto;
            }
        </style>
        <div class="modal-body">
            <form action="{{route('authority.update')}}" method="POST">
                @csrf
                <div class="row relative">
                    <div class="col-md-6 mb-3">
                        <label for="Insurer" class="form-label">Insurer*</label>
                        <select  placeholder="Select a Insurer" class="form-select select2selector" id="agent_id" name="insurer">
                            <option value=""> Select Unit</option>
                            @foreach($insurers as $insurer)
                                <option value="{!! $insurer['id'] !!}" @selected( $authority_value['insurer_id'] == $insurer['id'])> {!! $insurer->name !!}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Start Date*</label>
                        <input type="date" class="form-control" id="email" name="start_date" value="{!! $authority_value['start_date'] !!}" placeholder="Email"/>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="Phone" class="form-label">Expiry Date*</label>
                        <input type="date" class="form-control" id="Phone" name="exp_date" value="{!! $authority_value['expiry_date'] !!}" placeholder="Phone"/>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Single Job Limit*</label>
                        <input type="number" class="form-control" placeholder="Single Job Limit" value="{!! $authority_value['single_job_limit'] !!}" name="single_lim">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="number" class="form-label">Aggregate Limit*</label>
                        <input type="number" class="form-control" id="number" name="aggr_lim" value="{!! $authority_value['aggregate_limit'] !!}" placeholder="Aggregate Limit"/>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Minimum Bid(%)*</label>
                        <input type="number" class="form-control" placeholder="Minimum Bid" id="name" value="{!! $authority_value['minimum_bid'] !!}" name="minim_bid">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="Phone" class="form-label">Territory*</label>
                        <input type="number" class="form-control" id="Phone" name="territory" value="{!! $authority_value['territory'] !!}" placeholder="Territory"/>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="territory" class="form-label">Unit*</label>
                        <select  class="form-select" id="agent_id" name="territ_unit">
                            @foreach(territory_units() as $key => $dist)
                                <option value="{{$key}}"  @selected( $authority_value['territory_unit']== $key) >{{$dist}}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="name" class="form-label">Job Duration*</label>
                        <input type="text" class="form-control" placeholder="Job Duration" value="{!! $authority_value['job_duration'] !!}" name="job_dur">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="territory" class="form-label">Unit*</label>
                        <select class="form-select" id="agent_id" name="job_dur_unit">
                            @foreach(days_unit() as $key => $days)
                                <option value="{{$key}}" @selected( $authority_value['job_duration_unit']== $key)  >{{$days}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="email" class="form-label">Warranty Duration*</label>
                        <input type="number" class="form-control" id="email" name="warranty_dur" value="{!! $authority_value['warranty_duration'] !!}" placeholder="Warranty Duration"/>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="territory" class="form-label">Unit*</label>
                        <select class="form-select"  name="warranty_dur_unit">
                            @foreach(days_unit() as $key => $days)
                                <option value="{{$key}}" @selected( $authority_value['warranty_duration_unit']== $key)>{{$days}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="Phone" class="form-label">Payment Intervals*</label>
                        <input type="number" class="form-control" id="Phone" name="payment_intervals" value="{!! $authority_value['payment_interval'] !!}" placeholder="Payment Intervals"/>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="territory" class="form-label">Unit*</label>
                        <select class="form-select" id="agent_id" name="payment_intervals_unit">
                            @foreach(days_unit() as $key => $days)
                                <option value="{{$key}}" @selected( $authority_value['payment_interval_unit']== $key)>{{$days}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" class="form-control" name="authority_id" value="{!! $authority_value['id'] !!}"/>

                    <div class="col-md-4 mb-3">
                        <label for="email" class="form-label">Maintenance Limit*</label>
                        <input type="number" class="form-control" id="email" name="maintenance_limit" value="{!! $authority_value['maintenance_limit'] !!}" placeholder="Maintenance Limit"/>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="territory" class="form-label">Unit*</label>
                        <select class="form-select" id="agent_id" name="maintenance_limit_unit">
                            @foreach(days_unit() as $key => $days)
                                <option value="{{$key}}" @selected( $authority_value['maintenance_limit_unit']== $key)>{{$days}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="button" class="form_submit btn btn-success mt-3">Submit</button>
                <button type="button" class="btn btn-primary cancel-btn mt-3" data-bs-dismiss="modal" aria-label="Close">Cancel
                </button>
            </form>
        </div>
    </x-slot>
</x-custom-modal-component>
<script type="module">
    $(document).find('.select2selector').select2(
        {
            dropdownParent: $('#default_modal'),
        });
</script>

