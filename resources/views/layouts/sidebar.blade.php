<div class="position-sticky pt-3 sidebar">
    <ul class="nav flex-column">
        @if(isPermission('dashboard.index'))
            <li class="nav-item {!! isCurrentRoute('dashboard')?'live-active':'' !!}">
                <a class="nav-link" href="/">
                    <svg width="18" height="18" class="mr-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11 21H5C3.9 21 3 20.1 3 19V5C3 3.9 3.9 3 5 3H11V21ZM13 21H19C20.1 21 21 20.1 21 19V12H13V21ZM21 10V5C21 3.9 20.1 3 19 3H13V10H21Z" fill="white"></path>
                    </svg>
                   <span class="title-text">Dashboard</span>
                </a>
            </li>
        @endif

        @include('layouts.partials.user_management')
        @include('layouts.partials.customers')
        @include('layouts.partials.bonds')
        @include('layouts.partials.projects')
        @include('layouts.partials.insurer')
        @include('layouts.partials.agents')
        @include('layouts.partials.authority')
        @include('layouts.partials.settings')

    </ul>
</div>

