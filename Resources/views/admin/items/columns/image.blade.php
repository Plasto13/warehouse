@foreach($files as $file)
<img id="{{$id}}" src="@thumbnail($file['path'], 'smallThumb')" alt="item_image" data-toggle="modal" data-target="#photoModal" data-action-target="{{ $file['path'] }}" />
@endforeach
