@if ($errors->any())
<div class="alert alert-danger" id="errors">
    @foreach ($errors->all() as $err)
    <p class="mb-0 text-capitalize inline">{{$err}}</p>
    @endforeach
</div>
@endif
