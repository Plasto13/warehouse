<div class="btn-group btn-xs" style="width: 170px">
                        
        
    {{-- <a href="{{ route('admin.warehouse.issuecard.create',[$warehouse_id,$id]) }}" class="btn btn-succes btn-flat"><i class="fa-fw fa-hand-grab-o"></i></a> --}}
    <a href="{{ route('admin.warehouse.issuecard.create',[$item->warehouse_id,$item->id]) }}" class="btn btn-default btn-flat" title="{{trans('warehouse::items.button.create issuecard')}}"><i class="fa fa-exchange"></i></a>
    <a href="{{ route('admin.warehouse.item.edit',[$item->warehouse_id,$item->id]) }}" class="btn btn-default btn-flat" title="{{trans('warehouse::items.title.edit item')}}"><i class="fa fa-pencil"></i></a>
    <a href="#" data-toggle="modal" data-target="#myModal_{{$item->id}}" class="btn btn-default btn-flat" title="{{trans('warehouse::items.button.print')}}"><i class="fa fa-print"></i></a>
    <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.warehouse.item.destroy',[$item->warehouse_id,$item->id]) }}" title="{{trans('warehouse::items.destroy resource')}}"><i class="fa fa-trash"></i></button>
        
       
</div>
    <!-- Modal -->
<div id="myModal_{{$item->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">
  {!! Form::open(['route' => ['admin.warehouse.item.print',$item->warehouse_id], 'method' => 'post']) !!}
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Zvol Pocet stitkov</h4>
      </div>
      <div class="modal-body">
       
            <div id="name-group" class="form-group">
                <label for="num">Pocet Stitkov</label>
                <input type="number" class="form-control" name="num" value="1">
                <label for="printer_id">Tlaciaren</label>
                <select name="printer_id" class="form-control">
                @foreach($printerList as $printer)
                    <option value="{{ $printer->id }}" 
                        @if ($printer->default)
                            selected
                        @endif >
                        {{ $printer->title }}
                    </option>
                @endforeach
            
                </select>
             
            </div>
            <div id="name-group" class="form-group">
                <input type="hidden" class="form-control" name="item_id" value='{{$item->id}}'>                    
            </div>
            <input type="submit" value="Tlac" class="btn btn-primary" id="modal-save">

    

    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>            
      </div>
    </div>
    {!! Form::close() !!}
    </div>
</div>