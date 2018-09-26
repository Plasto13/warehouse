@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('warehouse::zebras.title.edit zebra') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.warehouse.zebra.index',$warehouse->id) }}">{{ trans('warehouse::zebras.title.zebras') }}</a></li>
        <li class="active">{{ trans('warehouse::zebras.title.edit zebra') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.warehouse.zebra.update',$warehouse->id, $zebra->id], 'method' => 'put']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                @include('partials.form-tab-headers')
                <div class="tab-content">

                    {!! Form::normalInput('title',trans('warehouse::zebra.form.barcode_title'),$errors,$zebra,['class'=>'form-control']) !!}

                    {!! Form::normalInput('ip', trans('warehouse::settings.form.barcode_ip'),$errors,$zebra,['class'=>'form-control data-mask--ip'])!!}

                    {!! Form::normalSelect('top_row', trans('warehouse::settings.form.top_row_barcode_field'),$errors,$itemCollumnList,
                            $zebra,['class'=>'form-control select2 select2', 'placeholder' => trans('warehouse::settings.form.top_row_barcode_field')])
                            !!}
                    {!! Form::normalSelect('second_row', trans('warehouse::settings.form.second_row_barcode_field'),$errors,$itemCollumnList,$zebra,
                            ['class'=>'form-control select2 select2', 'placeholder' => trans('warehouse::settings.form.second_row_barcode_field')])
                    !!}
                    {!! Form::normalSelect('third_row', trans('warehouse::settings.form.third_row_barcode_field'),$errors,$itemCollumnList,
                            $zebra,['class'=>'form-control select2 select2', 'placeholder' => trans('warehouse::settings.form.second_row_barcode_field')])
                    !!}
                    {!! Form::normalSelect('code_row', trans('warehouse::settings.form.code_row_barcode_field'),$errors,$itemCollumnList,
                            $zebra,['class'=>'form-control select2 select2', 'placeholder' => trans('warehouse::settings.form.code_row_barcode_field')])
                    !!}
                    {!! Form::normalCheckbox('default', trans('warehouse::zebras.form.default'),$errors,$zebra) !!}

                    <?php $i = 0; ?>
                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                        <?php $i++; ?>
                        <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                            @include('warehouse::admin.zebras.partials.edit-fields', ['lang' => $locale])
                        </div>
                    @endforeach

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.update') }}</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.warehouse.zebra.index',$warehouse->id)}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
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
                    { key: 'b', route: "<?= route('admin.warehouse.zebra.index',$warehouse->id) ?>" }
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
