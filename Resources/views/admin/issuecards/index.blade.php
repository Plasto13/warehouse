@extends('layouts.master')

@section('styles')
<link rel="stylesheet" href="{{asset('themes/adminlte/vendor/admin-lte/plugins/datepicker/datepicker3.css')}}">
<link rel="stylesheet" href="{!! Module::asset('base:css/select2.css') !!}" />
<link rel="stylesheet" href="{!! Module::asset('base:css/select2-bootstrap-dick.css') !!}"/>
@endsection

@push('css-stack')
    
    <style type="text/css">

    table input {
             max-width: 100px;
    }

    .m-b-0 {
    margin-bottom: 0px;
    }

    .base-filter label {
      color: #868686 ;
      font-weight: 600;
      text-transform: uppercase;
    }

    .navbar-filters {
      min-height: 25px !important;
      border-radius: 0 !important;
      margin-bottom: 10px !important;
      margin-left: -10px !important;
      margin-right: -10px!important ;
      margin-top: -11px !important;
      background: #f9f9f9 ;
      border-color: #f4f4f4 ;
    }

    .navbar-filters .navbar-collapse {
        padding: 0 !important;
    }

    .navbar-filters .navbar-toggle {
      padding: 10px 15px !important;
      border-radius: 0 !important;
    }

    .navbar-filters .navbar-brand {
      height: 25px !important;
      padding: 5px 15px !important;
      font-size: 14px !important;
      text-transform: uppercase !important;
    }
    @media (min-width: 768px) {
      .navbar-filters .navbar-nav>li>a {
          padding-top: 5px !important;
          padding-bottom: 5px !important;
      }
    }

    @media (max-width: 768px) {
      .navbar-filters .navbar-nav {
        margin: 0 !important;
      }
    }

    .select2-container {
        display: inline-block !important;
      }
      .select2-drop-active {
        border:none !important;
      }
      .select2-container .select2-choices .select2-search-field input, .select2-container .select2-choice, .select2-container .select2-choices {
        border: none !important;
      }
      .select2-container-active .select2-choice {
        border: none !important;
        box-shadow: none !important;
      }
    </style>
@endpush


@section('content-header')
    <h1>
        {{ trans('warehouse::issuecards.title.issuecards') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.warehouse.item.index',$warehouse->id) }}"><i class="fa fa-fa fa-database"></i> {{ $warehouse->name }}</a></li>
        <li class="active">{{ trans('warehouse::issuecards.title.issuecards') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.warehouse.issuecard.export',$warehouse->id) }}" title="{{ trans('warehouse::issuecards.button.export items') }}" style="padding: 4px 10px;" class="btn btn-primary btn-flat btn-info"><i class="fa fa-download"></i></a>
                    <button data-toggle="modal" data-target="#ImportModal" class="btn btn-primary btn-flat btn-info" title="{{ trans('warehouse::issuecards.button.import items') }}" style="padding: 4px 10px;">
                    <i class="fa fa-upload"></i></button>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @if (isset($base['filters']))
                        @include('base::inc.filter')
                    @endif
                    <div class="table-responsive">
                        {!! $html->table(['class'=>'table table-bordered table-hover dataTable'],true) !!}
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
    @include('core::partials.delete-modal')
        <div tabindex="-1" role="dialog" id="ImportModal" class="modal fade" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Import xls file</h4>
                    </div>
                    {!! Form::open(['route' => ['admin.warehouse.issuecard.import',$warehouse->id],'method'=>'POST','files'=>true]) !!}
                    <div class="modal-body">
                        <div class="form-group ">
                            {!! Form::label('import',trans('pimodule::equipment.form.import label')) !!}
                            {!! Form::file('import',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="modal-footer">
                        {!! Form::submit(trans('pimodule::equipment.form.import'),['class'=>'btn btn-block btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
                <!--Modal-->                
            </div>
        </div>

@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>c</code></dt>
        <dd>{{ trans('warehouse::issuecards.title.create issuecard') }}</dd>
    </dl>
@stop

@push('js-stack')
{!! $html->scripts() !!}


<script src="{{asset('themes/adminlte/vendor/admin-lte/plugins/datepicker/locales/bootstrap-datepicker.sk.js')}}"></script>
<script src="{{asset('themes/adminlte/vendor/admin-lte/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<script type="text/javascript">
    $('#datepicker-from').datepicker({
      autoclose: true,
      format: "dd.mm.yyyy",
       language: 'sk'
    });
    $('#datepicker-to').datepicker({
      autoclose: true,
      format: "dd.mm.yyyy",
       language: 'sk'
    });
</script>
<script src="{!! Module::asset('base:js/select2/select2.js') !!}"></script>

@endpush
