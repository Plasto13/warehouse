@if(isset($item->status))
@foreach($item->status as $stat)
<span class="{{$stat->icon}} label {{$stat->color}}" title="{{$stat->title}}" > {{$stat->title}}</span>
@endforeach
@endif