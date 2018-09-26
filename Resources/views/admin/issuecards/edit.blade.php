@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('warehouse::issuecards.title.edit issuecard') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
         <li><a href="{{ route('admin.warehouse.item.index',$warehouse->id) }}"><i class="fa fa-fa fa-database"></i> {{ $warehouse->name }}</a></li>
        <li><a href="{{ route('admin.warehouse.issuecard.index',$warehouse->id) }}">{{ trans('warehouse::issuecards.title.issuecards') }}</a></li>
        <li class="active">{{ trans('warehouse::issuecards.title.edit issuecard') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.warehouse.issuecard.update', $warehouse->id, $issuecard->id], 'method' => 'put']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                @include('partials.form-tab-headers')
                <div class="tab-content">

                    <div class="col-xs-3">
                       {!! Form::normalInputOfType('text','material_number', trans('warehouse::items.form.material_number'),$errors,$issuecard,['disabled']) !!}
                    </div> 
                    <div class="col-xs-3">
                      {!! Form::normalInput('local_name', trans('warehouse::items.form.local_name'),$errors,$issuecard,['disabled']) !!}
                    </div>
                    <div class="col-xs-3">
                        {!! Form::normalInput('name', trans('warehouse::items.form.name'),$errors,$issuecard,['disabled']) !!}
                    </div>    
                          
                    <div class="col-xs-3">
                           {!! Form::normalInput('user_full_name', trans('warehouse::issuecards.form.user_full_name'),$errors,$issuecard,['required']) !!}
                    </div>
                    <div class="col-xs-3">
                           {!! Form::normalSelect('costcenter_id', trans('warehouse::issuecards.form.costcenter_id'),$errors,$costcenters, $issuecard,['placeholder' => 'Vyber costcenter','required']) !!}
                    </div>
                    <div class="col-xs-3">
                           {!! Form::normalSelect('machinepart_id', trans('warehouse::issuecards.form.machinepart_id'),$errors,$machineparts, $issuecard) !!}
                    </div>
                   <div class="col-xs-3">
                        <div class="input-group" >
                            {!! Form::label('issuing_volume',trans('warehouse::issuecards.form.issuing_volume')) !!}
                                <div class="input-group">
                                {!! Form::number('issuing_volume', $issuecard->issuing_volume, ['required'=>true,'step'=>'0.01', 'class' => 'form-control', 'disabled']) !!}
                                    <div class="input-group-addon">
                                    <i>{{ $item->unit }}</i>
                                    </div>
                                </div>
                        </div>
                    </div>



                    <?php $i = 0; ?>
                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                        <?php $i++; ?>
                        <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                            @include('warehouse::admin.issuecards.partials.edit-fields', ['lang' => $locale])
                        </div>
                    @endforeach

                    <div class="row">
                                                <div class="col-xs-6">
                            {!! Form::normalTextarea('reason',trans('warehouse::issuecards.form.reason'),$errors) !!}
                        </div>
                        <div class="col-xs-6">
                            {!! Form::normalTextarea('remark',trans('warehouse::issuecards.form.remark'),$errors) !!}
                        </div>


                    </div>


                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.update') }}</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.warehouse.issuecard.index', $warehouse->id)}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
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
                    { key: 'b', route: "<?= route('admin.warehouse.issuecard.index', $warehouse->id) ?>" }
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
