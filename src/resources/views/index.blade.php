@extends(config('proshore.menu-management.layout-extend-path'))

@section('content')
    <table class="{{ config('proshore.menu-management.table-class') }}">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Menu</th>
            <th scope="col">URL</th>
            <th scope="col">Target Group</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @forelse($menuItems as $menuItem)
            <tr>
                <td>{{ $menuItem->name }}</td>
                <td>{{ $menuItem->menu->name }}</td>
                <td>{{ ($menuItem->type != 1)?url($menuItem->value): url('/pages/'.$menuItem->page->slug) }}</td>
                <td>{{ $menuItem->target_group_name }}</td>
                <td>
                    @if($menuItem->status)
                        <span class="badge badge-success">{{ $menuItem->status_name }}</span>
                    @else
                        <span class="badge badge-danger">{{ $menuItem->status_name }}</span>
                    @endif
                </td>
                <td>
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-info dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ __('More Action') }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            {!! link_to_route('menu-item.edit', 'Edit', $menuItem->id, ['class' => 'dropdown-item']); !!}
                            {!! Form::open(['route' => [ 'menu-item.destroy', $menuItem->id ], 'method' =>
                                            'DELETE']) !!}
                            {!! Form::submit( _('Delete'), ['class' => 'dropdown-item', 'onclick' => 'return confirm("'._("Are you sure you want to delete this?").'")',]) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
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
