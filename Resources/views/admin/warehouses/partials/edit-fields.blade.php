<div class="box-body">
     <div class="box-body">
        {!! Form::i18nInput('name', trans('warehouse::warehouses.form.name'),$errors, $lang, $warehouse) !!}
        {!! Form::normalInput('sap_id', trans('warehouse::warehouses.form.sap_id'),$errors, $warehouse)  !!}
        
        @if(is_module_enabled('Department'))
        {!! Form::normalCheckbox('department_only', trans('warehouse::warehouses.form.department_only'),$errors,$warehouse) !!}
        @endif

        {!! Form::i18nInput('description', trans('warehouse::warehouses.form.description'),$errors, $lang,$warehouse) !!}
    </div>
</div>
