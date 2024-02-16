<div class="position-sticky pt-3 sidebar">
    <ul class="nav flex-column">
        @if(isPermission('dashboard.index'))
            <li class="nav-item {!! isCurrentRoute('dashboard')?'live-active':'' !!}">
                <a class="nav-link" href="/">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-layers" aria-hidden="true">
                        <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                        <polyline points="2 17 12 22 22 17"></polyline>
                        <polyline points="2 12 12 17 22 12"></polyline>
                    </svg>
                    Dashboard
                </a>
            </li>
        @endif

        @include('layouts.partials.user_management')
        @include('layouts.partials.system_initialization')
        @include('layouts.partials.settings')
{{--        @include('layouts.partials.departments')--}}
{{--       <x-sidebar-dropdown>--}}
{{--            <x-slot name="label">--}}
{{--                Parent 1--}}
{{--            </x-slot>--}}
{{--            <li class="nav-item"><a class="nav-link" href="#">Child 1</a></li>--}}
{{--            <li class="nav-item"><a class="nav-link" href="#">Child 2</a></li>--}}
{{--            <li class="nav-item"><a class="nav-link" href="#">Child 3</a></li>--}}
{{--            <x-sidebar-dropdown>--}}
{{--                <x-slot name="label">--}}
{{--                    Parent 2--}}
{{--                </x-slot>--}}
{{--                <li class="nav-item"><a class="nav-link" href="#">Child 1</a></li>--}}
{{--                <li class="nav-item"><a class="nav-link" href="#">Child 2</a></li>--}}
{{--                <li class="nav-item"><a class="nav-link" href="#">Child 3</a></li>--}}
{{--                <x-sidebar-dropdown>--}}
{{--                    <x-slot name="label">--}}
{{--                        Parent 3--}}
{{--                    </x-slot>--}}
{{--                    <li class="nav-item"><a class="nav-link" href="#">Child 1</a></li>--}}
{{--                    <li class="nav-item"><a class="nav-link" href="#">Child 2</a></li>--}}
{{--                    <li class="nav-item"><a class="nav-link" href="#">Child 3</a></li>--}}
{{--                    <x-sidebar-dropdown>--}}
{{--                        <x-slot name="label">--}}
{{--                            Parent 4--}}
{{--                        </x-slot>--}}
{{--                        <li class="nav-item"><a class="nav-link" href="#">Child 1</a></li>--}}
{{--                        <li class="nav-item"><a class="nav-link" href="#">Child 2</a></li>--}}
{{--                        <li class="nav-item"><a class="nav-link" href="#">Child 3</a></li>--}}
{{--                        <x-sidebar-dropdown>--}}
{{--                            <x-slot name="label">--}}
{{--                                Parent 7--}}
{{--                            </x-slot>--}}
{{--                            <li class="nav-item"><a class="nav-link" href="#">Child 1</a></li>--}}
{{--                            <li class="nav-item"><a class="nav-link" href="#">Child 2</a></li>--}}
{{--                            <li class="nav-item"><a class="nav-link" href="#">Child 3</a></li>--}}
{{--                        </x-sidebar-dropdown>--}}
{{--                    </x-sidebar-dropdown>--}}
{{--                </x-sidebar-dropdown>--}}
{{--            </x-sidebar-dropdown>--}}
{{--        </x-sidebar-dropdown>--}}
        {{-- Dropdown Sample code --}}


    </ul>
</div>

