@extends('layouts.master')

@section('title')
 {{ trans('warehouse::warehouses.title.warehouses') }} | @parent
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
                        <table class="data-table table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>{{ trans('warehouse::warehouses.table.name') }}</th>
                                <th>{{ trans('warehouse::warehouses.table.sap_id') }}</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($warehouses)): ?>
                            <?php foreach ($warehouses as $warehouse): ?>
                            <tr>
                                 <td>
                                    <a href="{{ route('warehouse.guest.item.index', [$warehouse->id]) }}">
                                        {{ $warehouse->name }}
                                    </a>
                                </td>
                                 <td>
                                    <a href="{{ route('warehouse.guest.item.index', [$warehouse->id]) }}">
                                        {{ $warehouse->sap_id }}
                                    </a>
                                </td>
                                <td>
                                        {{ $warehouse->created_at }}
                                </td>
                                
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>{{ trans('warehouse::warehouses.table.name') }}</th>
                                <th>{{ trans('warehouse::warehouses.table.sap_id') }}</th>
                                <th>{{ trans('core::core.table.created at') }}</th>

                            </tr>
                            </tfoot>
                        </table>
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
    @include('warehouse::message.alert')
@stop