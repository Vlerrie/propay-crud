<div class="row justify-content-center my-1">
    <div class="col-md-6">
        @if(session()->has('success'))
            <div class="alert alert-success">{{session()->pull('success')}}</div>
        @endif
    </div>
</div>

