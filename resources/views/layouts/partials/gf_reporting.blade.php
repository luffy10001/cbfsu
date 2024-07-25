
@if(isPermission('notifications.index'))
    <x-sidebar-dropdown>
        <x-slot name="icon">
            <svg width="18" height="18" class="mr-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 4H4C2.9 4 2.01 4.9 2.01 6L2 18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V8C22 6.9 21.1 6 20 6H12L10 4Z" fill="white"/>
            </svg>
        </x-slot>
        <x-slot name="label">
            GF Reporting
        </x-slot>
        <x-slot name="activeTab">
{{--            {!! (isCurrentRoute('institution.index') )?'show':'' !!}--}}
        </x-slot>
{{--        @if(isPermission('institution.index'))--}}
            <li class="nav-item ml-3">
                <a class="nav-link" href="#">
                    GF Reporting
                </a>
            </li>
{{--        @endif--}}

    </x-sidebar-dropdown>
@endif