@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('warehouse::items.title.create item') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
         <li><a href="{{ route('admin.warehouse.item.index',$warehouse->id) }}"><i class="fa fa-fa fa-database"></i> {{ trans('warehouse::warehouses.title.warehouse') }}</a></li>
        <li><a href="{{ route('admin.warehouse.item.index',$warehouse->id) }}">{{ trans('warehouse::items.title.items') }}</a></li>
        <li class="active">{{ trans('warehouse::items.title.create item') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.warehouse.item.store',$warehouse->id], 'method' => 'post']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                @include('partials.form-tab-headers')
                <div class="tab-content">

                    <div class="col-xs-3">
                        {!! Form::normalInput('material_number', trans('warehouse::items.form.material_number').' '. $number->material_number,$errors) !!}
                    </div>

                    <div class="col-xs-3">
                        {!! Form::normalInput('name', trans('warehouse::items.form.name'),$errors) !!}
                    </div>
                        <div class="col-xs-3">
                        {!! Form::normalInput('local_name', trans('warehouse::items.form.local_name'),$errors) !!}
                    </div>
                    
                    <div class="col-xs-3">
                        {!! Form::normalInputOfType('number','quantity', trans('warehouse::items.form.quantity'),$errors,null,['step'=>'0.01']) !!}
                    </div>
                    <div class="col-xs-3">
                        {!! Form::normalInput('unit', trans('warehouse::items.form.unit'),$errors) !!}
                    </div>
                    <div class="col-xs-3">
                        {!! Form::normalInputOfType('number','minimum', trans('warehouse::items.form.minimum'),$errors,false,['value' => 1]) !!}
                    </div>
                    <div class="col-xs-3">
                        {!! Form::normalInputOfType('number','maximum', trans('warehouse::items.form.maximum'),$errors) !!}
                    </div>
                    <div class="col-xs-3">
                        {!! Form::normalInput('specification', trans('warehouse::items.form.specification'),$errors) !!}
                    </div>
                    <div class="col-xs-3">
                        {!! Form::normalInput('order_number', trans('warehouse::items.form.order_number'),$errors) !!}
                    </div>
                    <div class="col-xs-3">
                        {!! Form::normalInput('price', trans('warehouse::items.form.price'),$errors) !!}
                    </div>
                    <div class="col-xs-3">
                        {!! Form::normalInput('storage_position', trans('warehouse::items.form.storage_position'),$errors) !!}
                    </div>
                    <div class="col-xs-3">
                        {!! Form::normalInput('manufacture', trans('warehouse::items.form.manufacture'),$errors) !!}
                    </div>
                    <div class="col-xs-3">
                        {!! Form::normalInput('documentation_number', trans('warehouse::items.form.documentation_number'),$errors) !!}
                    </div>
                    <div class="col-xs-3">
                        {!! Form::normalInput('supplier', trans('warehouse::items.form.supplier'),$errors) !!}
                    </div>

                    <div class="col-xs-6">
                        {!! Form::normalInput('url', trans('warehouse::items.form.url'),$errors) !!}
                    </div>

                    <div class="col-xs-3">
                        @mediaSingle('photo',null,null, trans('warehouse::items.form.photo'))
                    </div>  
                    <div class="col-xs-3">
                    {!! Form::normalSelect('status', trans('warehouse::items.form.status'), $errors, $status, null,['placeholder' => 'Select Status', 'multiple'=>'multiple']) !!}
                    </div>             
                    
                    <div class="col-xs-12">
                        {!! Form::normalTextarea('suppliers', trans('warehouse::items.form.suppliers'),$errors) !!}
                    </div>
                    <div class="col-xs-12">
                        {!! Form::normalTextarea('remarks', trans('warehouse::items.form.remarks'),$errors) !!}
                    </div>
                    
                    <?php $i = 0; ?>
                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                        <?php $i++; ?>
                        <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                            @include('warehouse::admin.items.partials.create-fields', ['lang' => $locale])
                        </div>
                    @endforeach
                    <div class="row">
                        <div class="col-xs-3">
                            {!! Form::normalCheckbox('published', trans('warehouse::items.form.published'),$errors) !!}
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.create') }}</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.warehouse.item.index',$warehouse->id)}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                    </div>
                </div>
            </div> {{-- end nav-tabs-custom --}}
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('warehouse::warehouses.back to index') }}</dd>
        <dt><code>ctrl+s</code></dt>
        <dd>{{ trans('warehouse::warehouses.save') }}</dd>
    </dl>

@stop

@push('js-stack')
<script>
        // Ctrl+S and Cmd+S trigger Save button click
        $(document).keydown(function(e) {
            if ((e.which == '115' || e.which == '83' ) && (e.ctrlKey || e.metaKey))
            {
                e.preventDefault();
                // alert("Ctrl-s pressed");
                $("button[type=submit]").trigger('click');
                return false;
            }
            return true;
        });
</script>

    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.warehouse.item.index',$warehouse->id) ?>" }
                ]
            });
        });
    </script>
    <script>
        $( document ).ready(function() {
            $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });
        });
    </script>
@endpush
