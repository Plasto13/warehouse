<div class="box-body">
    <div class="box-body">
        {!! Form::i18nInput('name', trans('warehouse::warehouses.form.name'),$errors, $lang) !!}
        {!! Form::normalInput('sap_id', trans('warehouse::warehouses.form.sap_id'),$errors) !!}

        @if(is_module_enabled('Department'))
        {!! Form::normalCheckbox('department_only', trans('warehouse::warehouses.form.department_only'),$errors) !!}
        @endif
        
        {!! Form::i18nInput('description', trans('warehouse::warehouses.form.description'),$errors, $lang) !!}
    </div>
</div>
