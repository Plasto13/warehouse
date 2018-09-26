@extends('layouts.master')

@push('css-stack')
    <link type="text/css" rel="stylesheet" href="{{ asset('modules/warehouse/plugins/select2/select2.min.css') }}"/>
@endpush

@section('content-header')
    <h1>
        {{ trans('warehouse::settings.title.edit settings') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.warehouse.item.index',$warehouse->id) }}"><i class="fa fa-fa fa-database"></i> {{ $warehouse->name }}</a></li>
        <li class="active">{{ trans('warehouse::settings.title.settings') }}</li>     
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.warehouse.settings.update', $warehouse->id], 'method' => 'put']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
               
                <div class="tab-content">
                    {!! Form::normalSelect('disiabled_fileds',
                                trans('warehouse::settings.form.item disiabled_fileds'),
                                $errors,$itemCollumnList,
                                $settings,
                                ['multiple'=>true,'class'=>'select2-selection select2-selection--multiple']) 
                                !!}
                    {!! Form::normalSelect('issuecard_disabled_fields',
                                trans('warehouse::settings.form.issuecard disiabled_fileds'),
                                $errors,$issuecardCollumnList,
                                $settings,
                                ['multiple'=>true,'class'=>'select2-selection select2-selection--multiple']) 
                                !!}
                    {!! Form::normalSelect('item_guest_disabled_fields',
                                trans('warehouse::settings.form.item item_guest_disabled_fields'),
                                $errors,$itemCollumnList,
                                $settings,
                                ['multiple'=>true,'class'=>'select2-selection select2-selection--multiple']) 
                                !!}
                    {!! Form::normalSelect('issuecard_guest_disabled_fields',
                                trans('warehouse::settings.form.item issuecard_guest_disabled_fields'),
                                $errors,$issuecardCollumnList,
                                $settings,
                                ['multiple'=>true,'class'=>'select2-selection select2-selection--multiple']) 
                                !!}
                    {!! Form::normalSelect('issue_card_sap_export',trans('warehouse::settings.form.issue_card_sap_export'),
                                $errors,$issuecardCollumnList,
                                $settings,
                                ['multiple'=>true,'class'=>'select2-selection select2-selection--multiple']) 
                                !!}
                    {!! Form::normalSelect('item_required_field', trans('warehouse::settings.form.item_required_field'),$errors,
                            $itemCollumnList,$settings,['multiple'=>true,'class'=>'select2-selection select2-selection--multiple']) 
                            !!}
                    {!! Form::normalCheckbox('item_footer_search', trans('warehouse::settings.form.item_footer_search'),$errors,$settings) !!}
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.update') }}</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.warehouse.settings.index',$warehouse->id)}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
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
        <dd>{{ trans('core::core.back to index') }}</dd>
    </dl>
@stop

@push('js-stack')
<script type="text/javascript" src="{{ asset('modules/warehouse/plugins/select2/select2.full.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('modules/warehouse/plugins/input-mask/jquery.inputmask.js') }}"></script>
<script>
    $(function () {
    //Initialize Select2 Elements
    $('.select2-selection--multiple').select2()
    $('.data-mask--ip').inputmask('9[9][9].9[9][9].9[9][9].9[9][9]')

    }); 
</script>
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.warehouse.settings.index',$warehouse->id) ?>" }
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
