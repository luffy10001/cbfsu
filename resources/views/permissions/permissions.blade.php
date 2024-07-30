<x-app-layout>
    <x-slot name="header">
        <h2>{{ __('Role Permissions') }}</h2>
    </x-slot>

    <div>

        <div class="accordion" id="accordionExample">

            @foreach($groups as $key => $group)

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button  {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse"
                                data-bs-target="#app_{!! str_replace(' ','_',$key) !!}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                aria-controls="collapseOne">
                            {!! $key !!}
                        </button>
                    </h2>
                    <div id="app_{!! str_replace(' ','_',$key) !!}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                         data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="form-check">
                                <input class="form-check-input inputChecked" type="checkbox" value=""
                                       id="{!! 'input_'.str_replace(' ','_',$key) !!}">
                                <label class="form-check-label" for="{!! 'input_'.str_replace(' ','_',$key) !!}">
                                    Select All
                                </label>
                            </div>
                            <ul class="list-group">
                                @foreach($group as $row)
                                    <li class="list-group-item">
                                        <div class="form-check">
                                            <input
                                                    {!! isPermission($row['route'],$role)?'checked':'' !!}
                                                    token="{!! csrf_token() !!}"
                                                    url="{!! route('roles.permission.store') !!}"
                                                    role_id="{!! $role->id !!}"
                                                    class="form-check-input form-checkbox-mws" type="checkbox"
                                                    value="{!! $row['route'] !!}"
                                                    id="{!! str_replace('.','_',$row['route']) !!}">
                                            <label class="form-check-label"
                                                   for="{!! str_replace('.','_',$row['route']) !!}">
{{--                                                {!! $row['route'] !!}--}}
                                                {!! $row['title'] !!}
                                            </label>
                                        </div>
                                    </li>
                                @endforeach

                            </ul>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
    @push('scripts')

        <script type="module">
            $(document).ready(function () {
                $('body').on('change', '.inputChecked', function () {
                    const elem = $(this);
                    const permissions = [];
                    let url = '';
                    const allCheckboxs = elem.parents('div.accordion-body').find('.list-group-item input[type="checkbox"]');
                    allCheckboxs.map(async (i, row) => {
                        row = $(row);
                        if (row.is(':checked')) {
                            row.prop('checked', elem.is(':checked'));
                        } else {
                            row.prop('checked', elem.is(':checked'));
                        }
                        url = row.attr('url');
                        permissions.push({
                            roleId: row.attr('role_id'),
                            permission: row.val(),
                            isChecked: row.is(':checked') ? 1 : 0,
                            _token: row.attr('token')
                        })
                    })
                    console.log(permissions);
                    if (url) {
                        $.ajax({
                            url: url,
                            type: 'post',
                            data: {
                                permissions: permissions
                            },
                            beforeSend: function () {
                                showLoader()
                            },
                            success: function (res) {
                                if (res.success) {
                                    window.toastr.success(res.message)
                                }
                                hideLoader()
                            },
                            error: function (error) {
                                hideLoader()
                                showError(error)
                            }
                        })
                    }
                })
            });
        </script>
    @endpush
</x-app-layout>
