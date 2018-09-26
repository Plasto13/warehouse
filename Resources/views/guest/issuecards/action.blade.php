<div class="btn-group btn-xs" style="width: 170px">
@if(!$exported)                
    <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('warehouse.guest.issuecard.destroy',[$warehouse_id,$id]) }}" title="{{trans('warehouse::issuecards.destroy resource')}}"><i class="fa fa-trash"></i></button>
@endif      
</div>