@if (count($msg) > 0)
<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <ul>
      @foreach($msg as $m)
        <li>{{ $m }};</li>
      @endforeach
    </ul>
</div>
@endif
