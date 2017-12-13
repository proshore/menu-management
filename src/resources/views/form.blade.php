<div class="form-group row">
    <label for="menu-id" class="col-sm-2 col-form-label">{{ __('Menu Container') }}</label>
    <div class="col-sm-10">
        {!! Form::select('menu_id', $menuContainers , null ,['class' => 'custom-select', 'id' => 'menu-id']) !!}
    </div>
</div>

<div class="form-group row">
    <label for="menu-item-name" class="col-sm-2 col-form-label">{{ __('Name') }}</label>
    <div class="col-sm-10">
        {!! Form::text('name', null ,['class' => 'form-control', 'id' => 'menu-item-name']) !!}
    </div>
</div>

<div class="form-group row">
    <label for="menu-item-type" class="col-sm-2 col-form-label">{{ __('Type') }}</label>
    <div class="col-sm-10">
        {!! Form::select('type', $menuTypes , null ,['class' => 'custom-select', 'id' => 'menu-item-type']) !!}
    </div>
</div>

<div class="form-group row">
    <label for="menu-item-value" class="col-sm-2 col-form-label">{{ __('Value') }}</label>
    <div class="col-sm-10">
        <div class="input-group">
            <span class="input-group-addon" id="menu-item-type-prefix"
                  style="{{ ((!isset($menuItem) && old('type') == 0 ) || (isset($menuItem) && $menuItem->type == '0'))?'display:block':'display:none'}}">{{ url('/') }}</span>
            {!! Form::text('value[]', null ,['class' => 'form-control', 'id' => 'menu-item-value', 'placeholder' => '/pages/example', 'style' => ((!isset($menuItem) &&  old('type') != 1) || (isset($menuItem) && $menuItem->type != '1'))?'display:block':'display:none']) !!}
            {!! Form::select('value[]', $pages , null ,['class' => 'custom-select', 'id' => 'menu-item-cms', 'style' => ((isset($menuItem) && $menuItem->type == '1') || old('type') == 1)?'display:block':'display:none']) !!}
        </div>

    </div>
</div>

<div class="form-group row">
    <label for="menu-item-target-group" class="col-sm-2 col-form-label">{{ __('Target group') }}</label>
    <div class="col-sm-10">
        {!! Form::select('target_group', config('proshore.menu-management.target-group') , null ,['class' => 'custom-select', 'id' => 'menu-item-target-group']) !!}
    </div>
</div>

<div class="form-group row">
    <label for="menu-item-id" class="col-sm-2 col-form-label">{{ __('Parent menu') }}</label>
    <div class="col-sm-10">
        {!! Form::select('menu_item_id', $menuItems , null ,['class' => 'custom-select', 'id' => 'menu-item-id']) !!}
    </div>
</div>

<div class="form-group row">
    <label for="menu-item-target-group" class="col-sm-2 col-form-label">{{ __('Status') }}</label>
    <div class="col-sm-10">
        {!! Form::select('status', $menuStatus , null ,['class' => 'custom-select', 'id' => 'menu-item-target-group']) !!}
    </div>
</div>


@push(config('proshore.menu-management.script-stack'))
<script type="application/javascript">
  var menuItemType = document.getElementById('menu-item-type');
  var menuItemtypePrefix = document.getElementById('menu-item-type-prefix');
  var menuItemValue = document.getElementById('menu-item-value');
  var menuItemCMS = document.getElementById('menu-item-cms');

  menuItemType.addEventListener('change', function () {
    console.log(menuItemType.value);
    menuItemValue.value = '';
    if (menuItemType.value == 2) { //External Link
      menuItemtypePrefix.style.display = 'none';
      menuItemCMS.style.display = 'none';
      menuItemValue.style.display = 'block';
      menuItemValue.placeholder = 'https://www.google.com';
    }
    else if (menuItemType.value == 1) { //CMS Page
      menuItemtypePrefix.style.display = 'none';
      menuItemValue.style.display = 'none';
      menuItemCMS.style.display = 'block';
    }
    else { //Internal Link
      menuItemCMS.style.display = 'none';
      menuItemtypePrefix.style.display = 'block';
      menuItemValue.style.display = 'block';
      menuItemValue.placeholder = '/pages/example'
    }
  });
</script>
@endpush
