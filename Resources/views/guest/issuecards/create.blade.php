@extends('layouts.master')


@section('content')
    {!! Form::open(['route' => ['warehouse.guest.issuecard.store',$warehouse->id], 'method' => 'post']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                {{-- @include('partials.form-tab-headers') --}}
                <div class="tab-content">
             
                    <div class="col-xs-3">
                       {!! Form::normalInputOfType('text','material_number', trans('warehouse::items.form.material_number'),$errors,$item,['disabled']) !!}
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

                    {!! Form::hidden('material_number',$item->material_number) !!}
                    {!! Form::hidden('item_id',$item->id) !!}
                    {!! Form::hidden('name',$item->name) !!}
                    {!! Form::hidden('local_name',$item->local_name) !!}
                    {!! Form::hidden('quantity',$item->quantity) !!}
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
                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('warehouse.guest.item.index',$warehouse->id)}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                    </div>
                </div>
            </div> {{-- end nav-tabs-custom --}}
        </div>
    </div>
    {!! Form::close() !!}
@stop


@push('js-stack')


@endpush
