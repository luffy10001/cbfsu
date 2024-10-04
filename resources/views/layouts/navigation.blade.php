<header class="navbar navbar-dark sticky-top bg-white flex-md-nowrap p-0 shadow nav-pad">
    <h1 class="page-title m-0">{!! $title??''!!}</h1>

    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 py-3" href="javascript:void(0)"></a>

    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    {{-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> --}}


    <div class="navbar-nav">



        <div class="nav-item text-nowrap">
            <div class="d-flex navItems">



                <?php $notifications = notifications(); ?>
                <div class="dropdown d-inline-block">

                    <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="toggleDropdown()">
                        <img src="{{ asset('/assets/icons/bellIcon.svg') }}" style="width:34px">
                        <span class="badge iconStyle rounded-pill messages-count" style="margin-left:-15px">{!! count($notifications)??0 !!}</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                         aria-labelledby="page-header-notifications-dropdown"
                         style="position: absolute;inset: auto auto auto auto;margin-left: 0px;  margin-top: -63px;transform: translate(-248px, 72px);"
                         data-popper-placement="bottom-end">
                        <div class="p-3">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <a href="{{route('notifications.index')}}" class="small"
                                       key="t-view-all"> @lang('View_All')</a>
                                </div>
                            </div>
                        </div>

                        @if(count($notifications)>0)
                            <div class="FixedHeightContainer">
                                <div id="all-notifications" class="scroller">

                                    @foreach ($notifications ?? [] as $notification)
                                        {{-- {{url('plot-request/'.$notification->data['request_id'])}} --}}
                                        <a href="{{url($notification->page_route_name)}}"
                                           {{--                                        <a href="#"--}}
                                           class="text-reset notification-item"
                                           onclick="mark_as_read('{{ $notification->id ?? '' }}')">
                                            <div class="media">
                                                <div class="avatar-xs me-3">
                                                    <span class="avatar-title bg-primary rounded-circle font-size-16"></span>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="mt-0 mb-1"
                                                        key="t-your-order">@lang($notification->message ?? '')</h6>
                                                    <div class="font-size-12 text-muted">
                                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span
                                                                    key="t-min-ago">@lang($notification->created_at->diffForHumans() ?? '')</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <hr>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div id="all-notifications" style="width:300px;height:50px;">
                                <div class="media">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title bg-primary rounded-circle font-size-16"></span>
                                    </div>
                                    <div class="media-body">
                                        <h6 class="mt-0 mb-1"
                                            key="t-your-order">No Notifications</h6>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="d-inline-block">
                    <div class="dropdown">
                        <button class="dropbtn">{!! auth()->user()->name??'' !!}</button>
                        <div class="dropdown-content">
                            <a href="{!! route('profile.edit') !!}">
                                {{ __('Profile') }}
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{!! route('logout') !!}"
                                   onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </a>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>


<input type="hidden" value="{{ route('notifications.read') }}" id="url_message">
<script>
    function mark_as_read(id) {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        u = $('#url_message').val();
        $.ajax({
            url: u,
            type: "post",
            data: {
                id: id,
                _token: CSRF_TOKEN,
            },
        })
    }
    $(document).ready(function(){

        var down = false;

        $('#bell').click(function(e){

            var color = $(this).text();
            if(down){

                $('#box').css('height','0px');
                $('#box').css('opacity','0');
                down = false;
            }else{

                $('#box').css('height','auto');
                $('#box').css('opacity','1');
                down = true;

            }

        });

    });
</script>

<script>
    function toggleDropdown() {
        var dropdownMenu = document.querySelector('.dropdown-menu');
        dropdownMenu.classList.toggle('show');
    }
</script>


