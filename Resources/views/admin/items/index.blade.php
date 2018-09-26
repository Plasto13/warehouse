@extends('layouts.master')

@section('styles')
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
        {{ trans('warehouse::items.title.items') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.warehouse.item.index',$warehouse->id) }}"><i class="fa fa-fa fa-database"></i> {{ $warehouse->name }}</a></li>
        <li class="active">{{ trans('warehouse::items.title.items') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.warehouse.item.create',$warehouse->id) }}" title="{{ trans('warehouse::items.title.create item') }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i>
                    </a>
                     <a href="{{ route('admin.warehouse.issuecard.index',$warehouse->id) }}" title="{{ trans('warehouse::issuecards.title.issuecards') }}" class="btn btn-default btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-exchange"></i>
                    </a>

                    <a href="{{ route('admin.warehouse.item.export', [$warehouse->id]) }}" title="{{ trans('warehouse::items.button.export items') }}" class="btn btn-default btn-flat" style="padding: 4px 10px;"><i class="fa fa-download"></i></a>
                    
                    <button data-toggle="modal" data-target="#ImportModal" class="btn btn-primary btn-flat btn-info" title="{{ trans('warehouse::items.button.import items') }}" style="padding: 4px 10px;">
                    <i class="fa fa-upload"></i></button>
                    <a href="{{ route('admin.warehouse.settings.index', [$warehouse->id]) }}" title="{{ trans('warehouse::settings.title.settings') }}" class="btn btn-default btn-flat" style="padding: 4px 10px;"><i class="fa fa-gear"></i></a>
                    <a href="{{ route('admin.warehouse.zebra.index', [$warehouse->id]) }}" title="{{ trans('warehouse::zebras.title.zebra settings') }}" class="btn btn-default btn-flat" style="padding: 4px 10px;"><i class="fa fa-print"></i></a>
                    <a href="{{ route('admin.warehouse.costcenter.index', [$warehouse->id]) }}" title="{{ trans('warehouse::costcenters.title.costcenters') }}" class="btn btn-default btn-flat" style="padding: 4px 10px;"><i class="fa fa-cc"></i></a>
                    <a href="{{ route('admin.warehouse.machinepart.index', [$warehouse->id]) }}" title="{{ trans('warehouse::machineparts.title.machineparts') }}" class="btn btn-default btn-flat" style="padding: 4px 10px;"><i class="fa  fa-wrench"></i></a>
                   
                    
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
                    <h4 class="modal-title">Import csv translations file</h4>
                </div>
                    {!! Form::open(['route' => ['admin.warehouse.item.import',$warehouse->id],'method'=>'POST','files'=>true]) !!}
                <div class="modal-body">
                    <div class="form-group ">
                        {!! Form::label('import',trans('warehouse::items.form.import label')) !!}
                        {!! Form::file('import',null,['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    {!! Form::submit(trans('warehouse::items.form.import'),['class'=>'btn btn-block btn-primary']) !!}
                </div>
                    {!! Form::close() !!}
                </div>
                <!--Modal-->                
            </div>
        </div>
    </div>

    <div id="photoModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body showimage">
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>c</code></dt>
        <dd>{{ trans('warehouse::items.title.create item') }}</dd>
    </dl>
@stop


@push('js-stack')

{!! $html->scripts() !!}
<script src="{!! Module::asset('base:js/select2/select2.js') !!}"></script>

<script>
$("#dataTableBuilder").on( 'draw.dt', function () {
  $('img').click(function () {
    var url = $(this).attr('data-action-target');
    console.log(url);
    image = new Image();
    image.src = url;
    image.className = 'img-responsive';
    console.log(image);
    image.onload = function () {
        $('.showimage').empty().append(image);
    };
    // image.onerror = function () {
    //     $('.showimage').empty().html('That image is not available.');
    // }

    // $('.showimage').empty().html('Loading...');

    // return false;
  });
});

   </script>
@endpush
