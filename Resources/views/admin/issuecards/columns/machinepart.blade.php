@if($machinepart = $warehouse->machinePart()->where('id','=',$issuecard->machinepart_id)->first())
{{ $machinepart->code }} - {{ $machinepart->title }}
@else
{{ trans('warehouse::issuecards.table.none') }} 
@endif
