@include('layouts.header_account')

@section('content')

    @include('layouts.aside')
    @yield('aside')

    @include('layouts.sketch_forms')
    @yield('sketch_forms')
  
  <section class="main-area">
      <div class="main-area__inner">
          <div class="customer-sketches-received">
              <div class="customer-sketches-received__title">
                {{$translates['sent_sketches']}}
              </div>
              <div class="customer-sketches-received__gallery">

                  @foreach ($sketches as $sketch)
                      
                    <form class="gallery-card" method="POST" action="" id="sketch-form-{{$sketch['id']}}">
                        @csrf
                        <input type="hidden" name="sketch_id" value="{{$sketch['id']}}">
                        <div class="gallery-card__top">
                            <div class="gallery-card__artist">
                                <img src="{{$is_artist ? $sketch['customer']['image'] : $sketch['artist']['image']}}" style="width: 40px; height: 40px;" alt=""> 
                                <span>{{$is_artist ? $sketch['customer']['full_name'] : $sketch['artist']['full_name']}}</span>
                            </div>
                            <div class="gallery-card__product">{{$sketch['title']}}</div>
                        </div>
                        <div class="gallery-card__middle">
                            <div class="container">
                                <div class="swiper-button-next"><i class="icon-arrow-slide-right"></i></div>
                                <div class="swiper-button-prev"><i class="icon-arrow-slide-left"></i></div>
                                <div class="swiper-container">
                                    <div class="swiper-wrapper">
                                        @foreach ($sketch['attachments'] as $attachment)
                                            <div class="swiper-slide"><div class="slider-inner"><img src="{{$attachment['file']}}" alt=""></div></div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                            <div class="slider-description">
                                <span>{{count($sketch['attachments'])}} {{$translates['files']}}</span>
                                <a class="download-sketch-btn pointer" data-id="{{$sketch['id']}}" data-action="{{$actions['download']}}">{{$translates['download']}}</a>
                            </div>
                        </div>
                        <div class="gallery-card__comments">
                            <div class="gallery-card__comments-title">{{$translates['artist_comment']}}</div>
                            <div class="gallery-card__comments-description">{{$sketch['comment']}}</div>
                            <div class="gallery-card__comments-link"><a href="/sketch/{{$sketch['id']}}">{{$translates['read_all']}} <i class="icon-arrow-slide-right"></i></a></div>
                        </div>
                        <div class="gallery-card__buttons">
                            @if ($is_artist)
                                <div class="btn--accept pointer"><a href="/sketch/{{$sketch['id']}}">{{$translates['details']}}</a></div>
                            @elseif(!$sketch['is_primary'])
                                <div class="btn--accept accept-sketch-btn pointer" data-id="{{$sketch['id']}}" data-action="{{$actions['accept']}}"><a>{{$translates['accept_sketch']}}</a></div>
                                @if($sketch['is_revisionable'])
                                    <div class="btn--revision btn-revision-sketch pointer" data-id="{{$sketch['id']}}""><a>{{$translates['revision']}}</a></div>
                                @endif
                                <div class="btn--cancel btn-cancel-sketch pointer" data-id="{{$sketch['id']}}"><a>{{$translates['cancel']}}</a></div>
                            @endif
                        </div>
                    </form>

                  @endforeach

              </div>
          </div>
      </div>
  </section>
	
	<!-- Load CSS -->
	
    <link rel="stylesheet"  href="{{asset('css/normalize.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/fonts.css')}}" />
    <link rel="stylesheet"  href="{{asset('css/swiper.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/header-lk.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/lk-13.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/footer-lk.css')}}" />

	<!-- Load Scripts -->
    <script src="{{asset('libs/anime.min.js')}}"></script>
    <script src="{{asset('js/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('js/server.js')}}"></script>
    <script src="{{asset('js/plugins-lk.js')}}"></script>
  <script>





  </script>
@endsection

@include('layouts.footer_account')