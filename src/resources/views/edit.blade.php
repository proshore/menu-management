@extends(config('proshore.menu-management.layout-extend-path'))

@section('content')
    {!! Form::model($menuItem, ['route' => ['menu-item.update', $menuItem->id],'method' => 'put', 'class' => config('proshroe-menu-management.form-class')]) !!}

        @include('MenuManagement::form')

        <div class="form-group row">
            <div class="col-sm-2">&nbsp;</div>
            <div class="col-sm-10">
                {!! Form::submit( _('Update'), ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    {!! Form::close() !!}
@endsection
