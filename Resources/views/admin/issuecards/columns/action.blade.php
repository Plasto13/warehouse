<div class="btn-group btn-xs" style="width: 170px">
@if(!$exported)                
    <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.warehouse.issuecard.destroy',[$warehouse_id,$id]) }}" title="{{trans('warehouse::issuecards.destroy resource')}}"><i class="fa fa-trash"></i></button>
@endif 
<a href="{{ route('admin.warehouse.item.edit',[$warehouse_id,$item_id]) }}" class="btn btn-default btn-flat" title="{{trans('warehouse::items.edit resource')}}"><i class="fa fa-pencil"></i></a>     
</div>
