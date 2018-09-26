@if($costcenter = $warehouse->costcenter()->where('id','=',$issuecard->costcenter_id)->withTrashed()->first())
{{ $costcenter->code }} - {{ $costcenter->title }}
@else
{{ trans('warehouse::issuecards.table.none') }} 
@endif
