<x-custom-modal-component>
    <x-slot name="title">
        {{ __('Area List') }}
    </x-slot>
    <x-slot name="body">
        <div class="container">
            <table class="table table-striped">
                @if($user_areas->count() > 0)
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user_areas as $user_area)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                {{$user_area->area->name}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                @else
                    <tbody>
                        <tr class="text-center"><td>No Area Assigned</td></tr>
                    </tbody>
                @endif
            </table>
        </div>
    </x-slot>
</x-custom-modal-component>


