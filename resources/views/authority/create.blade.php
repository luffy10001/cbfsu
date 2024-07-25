<x-custom-modal-component>
    <x-slot name="title">
        {{ __('Create Authority') }}
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
            <form action="{{route('authority.store')}}" method="POST">
                @csrf
                <div class="row relative">
                    <div class="col-md-6 mb-3">
                        <label for="Insurer" class="form-label">Insurer*</label>
                        <select  placeholder="Select a Insurer" class="form-select select2selector" id="agent_id" name="insurer">
                            <option value="0"> Select Unit</option>
                            @foreach($insurers as $insurer)
                                <option value="{!! $insurer['id'] !!}"> {!! $insurer->name !!}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Start Date*</label>
                        <input type="date" class="form-control" id="email" name="start_date" placeholder="Email"/>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="Phone" class="form-label">Expiry Date*</label>
                        <input type="date" class="form-control" id="Phone" name="exp_date" placeholder="Phone"/>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Single Job Limit*</label>
                        <input type="number" class="form-control" placeholder="Single Job Limit" name="single_lim">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="number" class="form-label">Aggregate Limit*</label>
                        <input type="number" class="form-control" id="number" name="aggr_lim" placeholder="Aggregate Limit"/>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Minimum Bid(%)*</label>
                        <input type="number" class="form-control" placeholder="Minimum Bid" id="name" name="minim_bid">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="Phone" class="form-label">Territory*</label>
                        <input type="number" class="form-control" id="Phone" name="territory" placeholder="Territory"/>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="territory" class="form-label">Unit*</label>
                        <select  class="form-select" id="agent_id" name="territ_unit">
                            @foreach(territory_units() as $key => $dist)
                                <option value="{{$key}}">{{$dist}}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="name" class="form-label">Job Duration*</label>
                        <input type="text" class="form-control" placeholder="Job Duration"  name="job_dur">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="territory" class="form-label">Unit*</label>
                        <select class="form-select" id="agent_id" name="job_dur_unit">
                            @foreach(days_unit() as $key => $days)
                                <option value="{{$key}}">{{$days}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="email" class="form-label">Warranty Duration*</label>
                        <input type="number" class="form-control" id="email" name="warranty_dur" placeholder="Warranty Duration"/>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="territory" class="form-label">Unit*</label>
                        <select class="form-select"  name="warranty_dur_unit">
                            @foreach(days_unit() as $key => $days)
                                <option value="{{$key}}">{{$days}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="Phone" class="form-label">Payment Intervals*</label>
                        <input type="number" class="form-control" id="Phone" name="payment_intervals" placeholder="Payment Intervals"/>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="territory" class="form-label">Unit*</label>
                        <select class="form-select" id="agent_id" name="payment_intervals_unit">
                            @foreach(days_unit() as $key => $days)
                                <option value="{{$key}}">{{$days}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="email" class="form-label">Maintenance Limit*</label>
                        <input type="number" class="form-control" id="email" name="maintenance_limit" placeholder="Maintenance Limit"/>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="territory" class="form-label">Unit*</label>
                        <select class="form-select" id="agent_id" name="maintenance_limit_unit">
                            @foreach(days_unit() as $key => $days)
                                <option value="{{$key}}">{{$days}}</option>
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

