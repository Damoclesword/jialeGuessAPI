@if(session('message'))
    @if(session('message')['status_code'] == 1)
        <div class="alert alert-success alert-dismissible" role="alert">
    @elseif(session('status_code')['status_code'] == 0)
        <div class="alert alert-danger alert-dismissible" role="alert">
    @endif
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                <strong>{{session('message')['msg']}}</strong>
        </div>
@endif