<div class="btn-group btn-xs" style="width: 170px">
                        
        
    {{-- <a href="{{ route('admin.warehouse.issuecard.create',[$warehouse_id,$id]) }}" class="btn btn-succes btn-flat"><i class="fa-fw fa-hand-grab-o"></i></a> --}}
    <a href="{{ route('warehouse.guest.issuecard.create',[$warehouse_id,$id]) }}" class="btn btn-default btn-flat" title="{{trans('warehouse::items.button.create issuecard')}}"><i class="fa fa-exchange"></i></a>
       
</div>
