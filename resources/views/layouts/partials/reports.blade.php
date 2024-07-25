<x-sidebar-dropdown>
    <x-slot name="icon">
        <svg width="18" height="18" class="mr-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15 15H3V17H15V15ZM15 7H3V9H15V7ZM3 13H21V11H3V13ZM3 21H21V19H3V21ZM3 3V5H21V3H3Z" fill="white"/>
        </svg>
    </x-slot>
    <x-slot name="label">
        Reports
    </x-slot>
    <x-slot name="activeTab">
        {{--            {!! ( isCurrentRoute('art.psm.index'))?'show':'' !!}--}}
    </x-slot>
    <li class="nav-item ml-3 ">
        <a class="nav-link" href="#">
            M&E Reports
        </a>
    </li>
    <li class="nav-item ml-3 ">
        <a class="nav-link" href="#">
            PSM Reports
        </a>
    </li>
    <li class="nav-item ml-3 ">
        <a class="nav-link" href="#">
            Finance Reports
        </a>
    </li>
</x-sidebar-dropdown>
