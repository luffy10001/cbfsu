<x-custom-modal-component>
    <x-slot name="title">
        {{ __('Edit Project') }}
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
            <form action="{{route('project.update')}}" method="POST">
                @csrf
                <div class="row relative">
                    <input type="hidden" class="form-control" name="pro_id" value="{!! $pm['id'] !!}"/>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Project Name*</label>
                        <input type="text" class="form-control"  name="project_name" placeholder="Project Name" value="{!! $pm['name'] !!}"/>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="name" class="form-label">Project State<span class="req text-danger">*</span></label>
                        <select target='select[name="city_id"]' placeholder="Select City"
                                url="{!! route('state.get-cities') !!}" params="province_id" name="province_id"
                                class="form-select changeInputMws input_province_id select2selector">
                            <option value="">Select State</option>
                            @foreach($provinces as $row)
                                <option value="{!! $row->id !!}" @selected($pm['state_id'] == $row->id )>{!! $row->name !!}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="city_id" class="form-label">Project City<span class="req text-danger">*</span></label>
                        <select name="city_id" class="form-select city_id_selector select2selector" >
                            @foreach($cities as $row)
                                <option value="{!! $row->id !!}" @selected($pm['city_id'] == $row->id ) >{!! $row->name !!}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Project Zip*</label>
                        <input type="text" class="form-control"  name="project_zip" placeholder="Project Zip" value="{!! $pm['zip'] !!}"/>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Project Address*</label>
                        <input type="text" class="form-control"  name="project_address" placeholder="Project Address" value="{!! $pm['address'] !!}"/>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Project Delivery Method*</label>
                        <input type="number" class="form-control"  name="project_delivery_method" placeholder="Project Delivery Method" value="{!! $pm['delivery_method'] !!}"/>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Estimate Project Start Date*</label>
                        <input type="date" class="form-control"  name="est_pro_start" value="{!! $pm['start_date'] !!}"/>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Estimate Project Completion Date*</label>
                        <input type="date" class="form-control"  name="est_pro_compl" value="{!! $pm['completion_date'] !!}"/>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Warranty Term*</label>
                        <input type="text" class="form-control"  name="warranty_term" placeholder="Warranty Term" value="{!! $pm['warranty_terms'] !!}"/>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Liquidated Damages*</label>
                        <input type="text" class="form-control"  name="liquidated_damages" placeholder="Liquidated Damages" value="{!! $pm['liquidated_damages'] !!}"/>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Retainage Amount*</label>
                        <input type="number" class="form-control"  name="retainage_amount" placeholder="Retainage Amount" value="{!! $pm['retain_amount'] !!}"/>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Current Backlog*</label>
                        <input type="text" class="form-control"  name="current_backlog" placeholder="Current Backlog" value="{!! $pm['current_backlog'] !!}"/>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Bid Date*</label>
                        <input type="date" class="form-control" name="bid_date" value="{!! $pm['bid_date'] !!}"/>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Bid Amount*</label>
                        <input type="number" class="form-control" name="bid_amount" placeholder="Bid Amount" value="{!! $pm['bid_amount'] !!}"/>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">GPM*</label>
                        <input type="number" class="form-control" name="gpm" placeholder="GPM" value="{!! $pm['gpm'] !!}"/>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Engineer Name*</label>
                        <input type="text" class="form-control"  name="engineer_name" placeholder="Engineer Name" value="{!! $pm['engineer_name'] !!}"/>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="Insurer" class="form-label">Oblige Name*</label>
                        <select  placeholder="Select a Insurer" class="form-select select2selector" id="oligee_name" name="insurer">
                            <option value=""> Select Oblige</option>
                            @foreach($insurers as $insurer)
                                <option value="{!! $insurer['id'] !!}" @selected( $pm['oblige_id'] == $insurer['id'])> {!! $insurer->name !!}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Oblige Address*</label>
                        <input type="text" class="form-control" id="obligee_address" name="obligee_address" value="{!! $pm['oblige_address'] !!}" disabled/>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="name" class="form-label">Oblige Sate<span class="req text-danger">*</span></label>
                        <select id="obligee_state" class="form-select select2selector" disabled>
                            <option value="0">Select State</option>
                            @foreach($provinces as $row)
                                <option value="{!! $row->id !!}" @selected($pm['oblige_state'] == $row->id)>{!! $row->name !!}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="city_id" class="form-label">Oblige City<span class="req text-danger">*</span></label>
                        <select name="city_name" class="form-select select2selector" id="obligee_city" disabled>
                            <option value="">Select City</option>
                            @foreach($obligee_cities as $value)
                                <option value="{!! $value['id']!!}" @selected($pm['oblige_city'] == $value->id)>{!! $value->name !!}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Oblige Zip*</label>
                        <input type="text" class="form-control" id="obligee_zip" name="obligee_zip" value="{!! $pm['oblige_zip'] !!}" disabled/>
                    </div>


                </div>
                <button type="button" class="form_submit btn btn-success mt-2">Submit</button>
                <button type="button" class="btn btn-primary cancel-btn mt-2" data-bs-dismiss="modal" aria-label="Close">Cancel
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

    // $(document).ready(function (){
    $('#oligee_name').on('change',function (){
        var insurer_id = $(this).val();
        if (insurer_id) {
            var url = '{{ url("get-insurer") }}/' + insurer_id;
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    $('#obligee_address').val(response.address)
                    $('#obligee_state').val(response.state_id).trigger('change');
                    $('#obligee_city').val(response.city_id).trigger('change');
                    $('#obligee_zip').val(response.zip)


                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Handle errors here
                    console.error(xhr.responseText);
                }
            });
        }
        })
    // });
</script>

