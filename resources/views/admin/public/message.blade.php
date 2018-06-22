@foreach(['success','danger'] as $k=>$v)
    @if(session($v))
    <div class="alert alert-{{$v}} alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>{{session()->get($v)}}</strong>
    </div>
    @endif
@endforeach