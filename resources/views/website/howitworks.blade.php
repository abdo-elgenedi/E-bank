@if((isset($howItWorksHeader)&&$howItWorksHeader->count()>0)||(isset($howItWorksCards)&&$howItWorksCards->count()>0))
<section class="site-section">
    <div class="container">


            <div class="row mb-5 justify-content-center">
                <div class="col-md-7 text-center">
                    <h2 class="section-title mb-3" data-aos="fade-up" data-aos-delay="">How It Works</h2>
                    <p class="lead" data-aos="fade-up" data-aos-delay="100">You can check the next cards to see how to use our services </p>
                </div>
            </div>


        @if(isset($howItWorksCards)&&$howItWorksCards->count()>0)
            <div class="row align-items-lg-center" >
                <div class="col-lg-6 mb-5" data-aos="fade-up" data-aos-delay="">

                    <div class="owl-carousel slide-one-item-alt">
                        @foreach($howItWorksCards as $howItWorksCard)
                            <img src="{{asset('images/howitworks/'.$howItWorksCard->image)}}" alt="Image" class="img-fluid">
                        @endforeach
                    </div>
                    <div class="custom-direction">
                        <a href="#" class="custom-prev"><span><span class="icon-keyboard_backspace"></span></span></a><a href="#" class="custom-next"><span><span class="icon-keyboard_backspace"></span></span></a>
                    </div>

                </div>
                <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="100">

                    <div class="owl-carousel slide-one-item-alt-text">
                        @foreach($howItWorksCards as $index=>$howItWorksCard)
                            <div>
                                <h2 class="section-title mb-3">{{($index+1).'.'.$howItWorksCard->head}}</h2>
                                <p>{{$howItWorksCard->paragraph}}</p>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        @endif
    </div>
</section>
@endif