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


{{--<input type="hidden" value="{{ route('notifications.getallnotifications') }}" id="url_all_notifications">--}}
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
</script>






