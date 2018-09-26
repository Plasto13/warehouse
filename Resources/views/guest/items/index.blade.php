@extends('layouts.master')

@section('title')
 {{ $warehouse->name }}-{{ trans('warehouse::items.title.items') }} | @parent
@stop

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
      background: #f9f9f9;
      border-color: #f4f4f4;
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
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('warehouse.guest.item.index',$warehouse->id) }}"><i class="fa fa-fa fa-database"></i> {{ $warehouse->name }}</a></li>
        <li class="active">{{ trans('warehouse::items.title.items') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                   
                     <a href="{{ route('warehouse.guest.issuecard.index',$warehouse->id) }}" title="{{ trans('warehouse::issuecards.title.issuecards') }}" class="btn btn-default btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-exchange"></i>
                    </a>                  
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
    @include('core::partials.delete-modal')
    @include('warehouse::message.alert')


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
