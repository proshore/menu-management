@extends(config('proshore.menu-management.layout-extend-path'))

@section('content')
    <table class="{{ config('proshore.menu-management.table-class') }}">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Slug</th>
        </tr>
        </thead>
        <tbody>
        @forelse($menuContainers as $menuContainer)
            <tr>
                <td>{{ $menuContainer->name }}</td>
                <td>{{ $menuContainer->slug }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="2" class="text-center">
                    {{ __('No records found') }}
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
