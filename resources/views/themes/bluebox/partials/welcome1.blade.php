<!-- Welcome Area-->
<section class="welcome-area" id="home">
      <!-- Background Shape-->
      <div class="background-shape">
        <div class="circle1 wow fadeInRightBig" data-wow-duration="4000ms"></div>
        <div class="circle2 wow fadeInRightBig" data-wow-duration="4000ms"></div>
        <div class="circle3 wow fadeInRightBig" data-wow-duration="4000ms"></div>
        <div class="circle4 wow fadeInRightBig" data-wow-duration="4000ms"></div>
      </div>
      <!-- Background Animation-->
      <div class="background-animation">
        <div class="star-ani"></div>
        <div class="cloud-ani"></div>
        <div class="triangle-ani"></div>
        <div class="circle-ani"></div>
        <div class="box-ani"></div>
      </div>
      <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-between">
          <!-- Welcome Content-->
          <div class="col-12 col-md-6 col-lg-5">
            <div class="welcome-content">
              <h2 class="wow fadeInUp" data-wow-duration="1000ms">@lang('global.OnlinePaymentSolutions')</h2>
              <p class="mb-4 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="200ms">
                 @lang('site.OPSDesc')
              </p>
                <a class="btn saasbox-btn white-btn mt-3 wow fadeInUp" href="{{url('dashboard')}}" data-wow-duration="1000ms" data-wow-delay="400ms">@lang('global.KnowMore')</a>
            </div>
          </div>
          <!-- Welcome Thumb-->
          <div class="col-10 col-md-6">
            <div class="welcome-thumb hero1 wow fadeInUp" data-wow-delay="300ms"><img src="{{asset('images/bg-img/payment-gate.svg')}}" alt=""></div>
          </div>
        </div>
      </div>
    </section>
