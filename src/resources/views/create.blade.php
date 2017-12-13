@extends(config('proshore.menu-management.layout-extend-path'))

@section('content')
    {!! Form::open(['route' => 'menu-item.store','method' => 'post', 'class' => config('proshore.menu-management.form-class')]) !!}

        @include('menu-management::form')

        <div class="form-group row">
            <div class="col-sm-2">&nbsp;</div>
            <div class="col-sm-10">
                {!! Form::submit( _('Save'), ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    {!! Form::close() !!}
@endsection
