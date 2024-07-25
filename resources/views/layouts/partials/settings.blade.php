
@if(isPermission('province.index') || isPermission('city.index') || isPermission('community.index')
     || isPermission('service.index') || isPermission('cbodepartments.index')
     || isPermission('focalpersontype.index') || isPermission('medicineCategory.index') || isPermission('infectionType.index')|| isPermission('assign_lot.index')
     || isPermission('lot.index') || isPermission('performanceLetterContent.index') )
    <x-sidebar-dropdown>
        <x-slot name="icon">
            <svg style="padding-right: 2px" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19.1401 12.9404C19.1801 12.6404 19.2001 12.3304 19.2001 12.0004C19.2001 11.6804 19.1801 11.3604 19.1301 11.0604L21.1601 9.48039C21.3401 9.34039 21.3901 9.07039 21.2801 8.87039L19.3601 5.55039C19.2401 5.33039 18.9901 5.26039 18.7701 5.33039L16.3801 6.29039C15.8801 5.91039 15.3501 5.59039 14.7601 5.35039L14.4001 2.81039C14.3601 2.57039 14.1601 2.40039 13.9201 2.40039H10.0801C9.84011 2.40039 9.65011 2.57039 9.61011 2.81039L9.25011 5.35039C8.66011 5.59039 8.12011 5.92039 7.63011 6.29039L5.24011 5.33039C5.02011 5.25039 4.77011 5.33039 4.65011 5.55039L2.74011 8.87039C2.62011 9.08039 2.66011 9.34039 2.86011 9.48039L4.89011 11.0604C4.84011 11.3604 4.80011 11.6904 4.80011 12.0004C4.80011 12.3104 4.82011 12.6404 4.87011 12.9404L2.84011 14.5204C2.66011 14.6604 2.61011 14.9304 2.72011 15.1304L4.64011 18.4504C4.76011 18.6704 5.01011 18.7404 5.23011 18.6704L7.62011 17.7104C8.12011 18.0904 8.65011 18.4104 9.24011 18.6504L9.60011 21.1904C9.65011 21.4304 9.84011 21.6004 10.0801 21.6004H13.9201C14.1601 21.6004 14.3601 21.4304 14.3901 21.1904L14.7501 18.6504C15.3401 18.4104 15.8801 18.0904 16.3701 17.7104L18.7601 18.6704C18.9801 18.7504 19.2301 18.6704 19.3501 18.4504L21.2701 15.1304C21.3901 14.9104 21.3401 14.6604 21.1501 14.5204L19.1401 12.9404ZM12.0001 15.6004C10.0201 15.6004 8.40011 13.9804 8.40011 12.0004C8.40011 10.0204 10.0201 8.40039 12.0001 8.40039C13.9801 8.40039 15.6001 10.0204 15.6001 12.0004C15.6001 13.9804 13.9801 15.6004 12.0001 15.6004Z" fill="white"/>
            </svg>

        </x-slot>
        <x-slot name="label">
            Settings
        </x-slot>
        <x-slot name="activeTab">
            {!! ( isCurrentRoute('province.index') || isCurrentRoute('city.index') || isCurrentRoute('community.index') || isCurrentRoute('service.index') ||
                isCurrentRoute('cbodepartments.index') || isCurrentRoute('focalpersontype.index')
                || isCurrentRoute('medicineCategory.index') || isCurrentRoute('infectionType.index')
                || isCurrentRoute('lot.index')|| isCurrentRoute('assign_lot.index')
                || isCurrentRoute('performanceLetterContent.index') || isCurrentRoute('performanceLetterContent.create') || isCurrentRoute('performanceLetterContent.edit') )?'show':'' !!}
        </x-slot>
        @if(isPermission('province.index'))
            <li class="nav-item ml-3 {!! isCurrentRoute('province.index')?'live-active':'' !!}">
                <a class="nav-link" href="{{route('province.index')}}">
                    Province
                </a>
            </li>
        @endif

        @if(isPermission('city.index'))
            <li class="nav-item ml-3 {!! isCurrentRoute('city.index')?'live-active':'' !!}">
                <a class="nav-link" href="{{route('city.index')}}">
                    Cities
                </a>
            </li>
        @endif

        @if(isPermission('community.index'))
            <li class="nav-item ml-3 {!! isCurrentRoute('community.index')?'live-active':'' !!}">
                <a class="nav-link" href="{{route('community.index')}}">
                    Communities
                </a>
            </li>
        @endif
        @if(isPermission('lot.index'))
            <li class="nav-item ml-3 {!! isCurrentRoute('lot.index')?'live-active':'' !!}">
                <a class="nav-link" href="{{route('lot.index')}}">
                    Manage Lots
                </a>
            </li>
        @endif
        @if(isPermission('assign_lot.index'))
            <li class="nav-item ml-3 {!! isCurrentRoute('assign_lot.index')?'live-active':'' !!}">
                <a class="nav-link" href="{{route('assign_lot.index')}}">
                    Assign Lots
                </a>
            </li>
        @endif

        @if(isPermission('service.index'))
            <li class="nav-item ml-3  {!! isCurrentRoute('service.index')?'live-active':'' !!}">
                <a class="nav-link" href="{{route('service.index')}}">
                    Services
                </a>
            </li>
        @endif

        @if(isPermission('cbodepartments.index'))
            <li class="nav-item ml-3 {!! isCurrentRoute('cbodepartments.index')?'live-active':'' !!}">
                <a class="nav-link" href="{{route('cbodepartments.index')}}">
                    Departments
                </a>
            </li>
        @endif

        @if(isPermission('focalpersontype.index'))
            <li class="nav-item ml-3 {!! isCurrentRoute('focalpersontype.index')?'live-active':'' !!}">
                <a class="nav-link" href="{{route('focalpersontype.index')}}">
                    Focal Person Type
                </a>
            </li>
        @endif



        @if(isPermission('medicineCategory.index'))
            <li class="nav-item ml-3 {!! isCurrentRoute('medicineCategory.index')?'live-active':'' !!}">
                <a class="nav-link" href="{{route('medicineCategory.index')}}">
                    Medicine Categories
                </a>
            </li>
        @endif

        @if(isPermission('infectionType.index'))
            <li class="nav-item ml-3 {!! isCurrentRoute('infectionType.index')?'live-active':'' !!}">
                <a class="nav-link" href="{{route('infectionType.index')}}">
                    Infection Types
                </a>
            </li>
        @endif

        @if(isPermission('performanceLetterContent.index'))
            <li class="nav-item ml-3 {!! isCurrentRoute('performanceLetterContent.index')?'live-active':'' !!}">
                <a class="nav-link" href="{{route('performanceLetterContent.index')}}">
                    Performance Letters Content
                </a>
            </li>
        @endif

    </x-sidebar-dropdown>
@endif
