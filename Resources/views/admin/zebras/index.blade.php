@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('warehouse::zebras.title.zebras') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.warehouse.item.index',$warehouse->id) }}"><i class="fa fa-fa fa-database"></i> {{ $warehouse->name }}</a></li>
        <li class="active">{{ trans('warehouse::zebras.title.zebras') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.warehouse.zebra.create',$warehouse->id) }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('warehouse::zebras.button.create zebra') }}
                    </a>
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
                                <th>{{ trans('warehouse::zebra.table.default') }}</th>
                                <th>{{ trans('warehouse::zebra.table.title') }}</th>
                                <th>{{ trans('warehouse::zebra.table.description') }}</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($zebras)): ?>
                            <?php foreach ($zebras as $zebra): ?>
                            <tr>
                                <td>
                                    {{ $zebra->default }}
                                </td>
                                <td>
                                    {{ $zebra->title }}
                                </td>
                                <td>
                                    {{ $zebra->description }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.warehouse.zebra.edit', [$warehouse->id,$zebra->id]) }}">
                                        {{ $zebra->created_at }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.warehouse.zebra.edit', [$warehouse->id,$zebra->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.warehouse.zebra.destroy', [$warehouse->id,$zebra->id]) }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>{{ trans('warehouse::zebra.table.default') }}</th>
                                <th>{{ trans('warehouse::zebra.table.title') }}</th>
                                <th>{{ trans('warehouse::zebra.table.description') }}</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th>{{ trans('core::core.table.actions') }}</th>
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
    @include('core::partials.delete-modal')
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>c</code></dt>
        <dd>{{ trans('warehouse::zebras.title.create zebra') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.warehouse.zebra.create',$warehouse->id) ?>" }
                ]
            });
        });
    </script>
    <?php $locale = locale(); ?>
    <script type="text/javascript">
        $(function () {
            $('.data-table').dataTable({
                "paginate": true,
                "lengthChange": true,
                "filter": true,
                "sort": true,
                "info": true,
                "autoWidth": true,
                "order": [[ 0, "desc" ]],
                "language": {
                    "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
                }
            });
        });
    </script>
@endpush
