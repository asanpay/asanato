@extends('layouts.simple')

@section('title')
    @lang('ipg.pay_transaction')
@endsection

@section('content')
<div class="section-body mt-3">
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-auto col-sm-12">

                @if (isset($errors) && $errors->any())

                    <div class="card google w_social">
                        <div>
                            @if(config('app.debug'))
                                {!! implode('', $errors->all('<div>:message</div>')) !!}
                            @endif
                        </div>
                        <hr>
                        <p class="mb-0">
                            <a href="#">@lang('global.BackToAccount')</a>
                        </p>
                    </div>

                @elseif(!isset($transaction) || !is_object($transaction))
                    <div class="card google w_social">
                        <div>
                            @lang('ipg.transaction_not_found')
                        </div>
                        <hr>
                        <p class="mb-0">
                            <a href="#">@lang('global.BackToAccount')</a>
                        </p>
                    </div>
                @else

                        <div class="card-body text-center ribbon">
                            <div class="ribbon-box orange ltr">#{{$transaction->id}}</div>
                            @if(isset($merchant) && is_object($merchant))
                                <img class="rounded-circle img-thumbnail w100" src="{{$merchant->logo ?? '/images/favicon.png'}}" alt="">
                                <h6 class="mt-3 mb-1">{{$merchant->name}}</h6>
                                <span><a href="{{$merchant->domain}}" rel="nofollow" target="_blank">{{$merchant->domain}}</a></span>
                                <br />
                            @endif

                            <small class="my-1">{{$transaction->description}}</small>

                            <div class="mt-3 d-flex justify-content-center">
                                {!! $form ?? '' !!}
                            </div>
                        </div>

                @endif
            </div>
        </div>
    </div>
</div>
@endsection

