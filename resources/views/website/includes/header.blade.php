<div class="site-blocks-cover overlay" style="background-image: url({{asset('assets/website/images/hero_2.jpg')}});" data-aos="fade" id="home-section">

    <div class="container">
        <div class="row align-items-center justify-content-center">


            <div class="col-md-10 mt-lg-5 text-center">
                <div class="single-text owl-carousel">
                     @if(isset($headers))
                         @foreach($headers as $header)
                            <div class="slide">
                                <h1 class="text-uppercase" data-aos="fade-up">{{$header->head}}</h1>
                                <p class="mb-5 desc"  data-aos="fade-up" data-aos-delay="100">{{$header->paragraph}}</p>
                                @guest()
                                <div data-aos="fade-up" data-aos-delay="100">
                                    <a href="{{route('login')}}" target="_self" class="btn  btn-primary mr-2 mb-2">Get In Touch</a>
                                </div>
                                @endguest
                            </div>
                        @endforeach
                     @endif

                </div>
            </div>

        </div>
    </div>

    <a href="#next" class="mouse smoothscroll">
        <span class="mouse-icon">
          <span class="mouse-wheel"></span>
        </span>
    </a>
</div>