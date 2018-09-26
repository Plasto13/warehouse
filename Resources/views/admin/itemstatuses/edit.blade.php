@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('warehouse::itemstatuses.title.edit itemstatus') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.warehouse.itemstatus.index') }}">{{ trans('warehouse::itemstatuses.title.itemstatuses') }}</a></li>
        <li class="active">{{ trans('warehouse::itemstatuses.title.edit itemstatus') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.warehouse.itemstatus.update', $itemstatus->id], 'method' => 'put']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                @include('partials.form-tab-headers')
                <div class="tab-content">
                    <div class="box-body">
                        <div class="col-md-2">
                            {!! Form::normalInput('title', trans('warehouse::itemstatuses.table.title'), $errors, $itemstatus) !!}
                        </div>
                        <div class="col-md-2">
                            {!! Form::normalInput('icon', trans('warehouse::itemstatuses.table.icon'), $errors, $itemstatus) !!}
                        </div>
                        <div class="col-md-2">
                            {!! Form::normalSelect('color',
                                trans('warehouse::itemstatuses.table.color'),
                                $errors,
                                ['' => 'Select Color',
                                'bg-orange' => 'Orange',
                                'bg-light-blue' => 'Light blue',
                                'bg-aqua' => 'Aqua',
                                'bg-green' => 'Green',
                                'bg-yellow' => 'Yellow',
                                'bg-navy' => 'Navy',
                                'bg-teal' => 'Teal',
                                'bg-purple' => 'Purple',
                                'bg-maroon' => 'Maroon',
                                'bg-black' => 'Black',
                              ],$itemstatus) !!}
                        </div>
                    </div>
                    <?php $i = 0; ?>
                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                        <?php $i++; ?>
                        <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                            @include('warehouse::admin.itemstatuses.partials.edit-fields', ['lang' => $locale])
                        </div>
                    @endforeach

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.update') }}</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.warehouse.itemstatus.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
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
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.warehouse.itemstatus.index') ?>" }
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
