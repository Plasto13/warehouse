@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('warehouse::items.title.items') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('warehouse.guest.item.index',$warehouse->id) }}"><i class="fa fa-fa fa-database"></i> {{ $warehouse->name }}</a></li>
        <li class="active">{{ trans('warehouse::issuecards.title.issuecards') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                   
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        {!! $html->table(['class'=>'table table-bordered table-hover dataTable'],true) !!}
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
    @include('core::partials.delete-modal')
@stop


@push('js-stack')
 {!! $html->scripts() !!}
 @include('warehouse::message.alert')
@endpush

