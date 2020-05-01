@extends('themes.flatron.mainbox')
@section('title')
    @lang('ipg.transaction_result')
@endsection
@section('content')
<div class="section-body mt-3">
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-auto col-sm-12">
                @if(isset($error) && !empty($error))
                    <div class="card google w_social">
                        <div>
                            @if(config('app.debug'))
                                @lang('global.Error'): {{$error}}
                            @endif
                        </div>
                        <hr>
                        <p class="mb-0">
                            <a href="#">@lang('global.BackToAccount')</a>
                        </p>
                    </div>
                @else
                    <div class="card">
                    <div class="card-body text-center ribbon">
                        <div class="mt-3 d-flex justify-content-center">
                            <div class="alert alert-{{empty($error) ? 'success' : 'danger'}}" role="alert">
                                <h4 class="alert-heading">عملیات موفق</h4>
                                <p class="mt-3">
                                    شارژ کیف پول
                                    <strong>{{$transaction->wallet->name}}</strong>
                                    شما به مبلغ
                                    <strong>{{money($transaction->amount, true)}}</strong>
                                    با موفقیت انجام شد.
                                </p>
                                <hr>
                                <p class="mb-0">
                                    <a href="#">@lang('global.BackToAccount')</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

