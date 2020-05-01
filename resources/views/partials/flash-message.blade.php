<div class="section-body mt-3">
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-md-auto">
                @if ($message = Session::get('alert-success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert"></button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif

                @if ($message = Session::get('alert-danger'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert"></button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif


                @if ($message = Session::get('alert-warning'))
                    <div class="alert alert-warning alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert"></button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif


                @if ($message = Session::get('alert-info'))
                    <div class="alert alert-info alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert"></button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif

                @if (isset($errors) && $errors->any())
                    <div class="alert alert-danger fade show">
                        {!! implode('', $errors->all('<div>:message</div>')) !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
