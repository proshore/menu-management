@extends(config('proshore.menu-management.layout-extend-path'))

@section('content')
    <table class="{{ config('proshore.menu-management.table-class') }}">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Status</th>
        </tr>
        </thead>
        <tbody>
        @forelse($menuItems as $menuItem)
            <tr>
                <td>{{ $menuItem->name }}</td>
                <td>
                    @if($menuItem->status)
                        <span class="badge badge-success">{{ $menuItem->status_name }}</span>
                    @else
                        <span class="badge badge-danger">{{ $menuItem->status_name }}</span>
                    @endif
                </td>
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
