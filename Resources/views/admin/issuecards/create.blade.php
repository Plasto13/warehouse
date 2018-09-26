@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('warehouse::issuecards.title.create issuecard') }} {{trans('for')}} {{$item->name}} 
        <small>({{$item->local_name}})</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.warehouse.issuecard.index',$warehouse->id,$item->id) }}">{{ trans('warehouse::issuecards.title.issuecards') }}</a></li>
        <li class="active">{{ trans('warehouse::issuecards.title.create issuecard') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.warehouse.issuecard.store',$warehouse->id], 'method' => 'post']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                @include('partials.form-tab-headers')
                <div class="tab-content">
             
                    <div class="col-xs-3">
                       {!! Form::normalInputOfType('text','material_number', trans('warehouse::items.form.material_number'),$errors,$item,['disabled']) !!}
                    </div> 
                    <div class="col-xs-3">
                      {!! Form::normalInput('local_name', trans('warehouse::items.form.local_name'),$errors,$item,['disabled']) !!}
                    </div>
                    <div class="col-xs-3">
                        {!! Form::normalInput('name', trans('warehouse::items.form.name'),$errors,$item,['disabled']) !!}
                    </div>    
                          
                    <div class="col-xs-3">
                           {!! Form::normalInput('user_full_name', trans('warehouse::issuecards.form.user_full_name'),$errors,null,['required']) !!}
                    </div>
                    <div class="col-xs-3">
                           {!! Form::normalSelect('costcenter_id', trans('warehouse::issuecards.form.costcenter_id'),$errors,$costcenters, null,['placeholder' => trans('warehouse::issuecards.form.select costcenter'),'required' => 'required']) !!}
                    </div>
                    <div class="col-xs-3">
                           {!! Form::normalSelect('machinepart_id', trans('warehouse::issuecards.form.machinepart_id'),$errors,$machineparts,null, ['placeholder' => trans('warehouse::issuecards.form.select machineparts')]) !!}
                    </div>
                   <div class="col-xs-3">
                        <div class="input-group" >
                            {!! Form::label('issuing_volume',trans('warehouse::issuecards.form.issuing_volume')) !!}
                                <div class="input-group">
                                {!! Form::number('issuing_volume', null, ['required'=>true,'step'=>'0.01', 'class' => 'form-control']) !!}
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
                            @include('warehouse::admin.issuecards.partials.create-fields', ['lang' => $locale])
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
                    {!! Form::hidden('item_id', $item->id) !!}
                    {!! Form::hidden('material_number', $item->material_number) !!}
                    {!! Form::hidden('name', $item->name) !!}
                    {!! Form::hidden('local_name', $item->local_name) !!}
                    {!! Form::hidden('quantity', $item->quantity) !!}
                    {!! Form::hidden('minimum',$item->minimum) !!}
                    {!! Form::hidden('maximum',$item->maximum) !!}
                    {!! Form::hidden('specification',$item->specification) !!}
                    {!! Form::hidden('order_number',$item->order_number) !!}
                    {!! Form::hidden('price',$item->price) !!}
                    {!! Form::hidden('storage_position',$item->storage_position) !!}
                    {!! Form::hidden('manufacture',$item->manufacture) !!}
                    {!! Form::hidden('documentation_number',$item->documentation_number) !!}
                    {!! Form::hidden('url',$item->url) !!}
                    {!! Form::hidden('supplier',$item->supplier) !!}
                    {!! Form::hidden('suppliers',$item->suppliers) !!}


                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.create') }}</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.warehouse.issuecard.index',$warehouse->id)}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
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
<script>
        // Ctrl+S and Cmd+S trigger Save button click
        $(document).keydown(function(e) {
            if ((e.which == '115' || e.which == '83' ) && (e.ctrlKey || e.metaKey))
            {
                e.preventDefault();
                // alert("Ctrl-s pressed");
                $("button[type=submit]").trigger('click');
                return false;
            }
            return true;
        });
</script>

    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.warehouse.issuecard.index',$warehouse->id) ?>" }
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
