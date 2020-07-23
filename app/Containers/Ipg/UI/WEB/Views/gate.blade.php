@extends('layouts.simple')

@section('title')
    @lang('ipg.pay_transaction')
@endsection

@section('content')
<div class="section-body">
    <div>
        <div class="row justify-content-md-center">
            <div class="col-auto col-sm-12">

                @if (isset($errors) && $errors->any())

                    <div class="card google w_social">
                        <div>
                            {!! implode('', $errors->all('<div>:message</div>')) !!}
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
                            <div class="ribbon-box tx-id mb-4">@lang('Transaction ID'):&nbsp;<span class="ltr text-red">{{$transaction->id}}</span></div>
                            @if(isset($merchant) && is_object($merchant))
                                <img class="rounded-circle img-thumbnail w128" src="{{$merchant->logo ?? '/images/merchant-store-blue.svg'}}" alt="">
                                <h6 class="mt-3 mb-2">{{$merchant->name}}</h6>
                                <span><a href="{{$merchant->domain}}" rel="nofollow" target="_blank">{{$merchant->domain}}</a></span>
                                <br />
                            @endif

                            <small class="my-1">{{$transaction->description}}</small>

                            <div class="mt-3 d-flex justify-content-center heJPTM">
                                {!! $form ?? '' !!}
                            </div>


                        </div>

                @endif
            </div>
        </div>
    </div>
</div>
@endsection

