@include('layouts.header_account')

@section('content')

    @include('layouts.aside')
    @yield('aside')
	
  <section class="main-area">
      <div class="main-area__inner">
          <div class="wish-list-painters">
              <div class="wish-list-painters__title">{{$translates['favorite_artists']}}</div>
              <div class="wish-list-painters__description">{{$translates['count']}}: <span>{{count($artists)}} {{$translates['pieces']}}</span></div>
              <div class="painters-gallery">

                @foreach ($artists as $artist)
                  <div class="gallery-card__body">
                      <div class="gallery-card__inner">
                          <div class="gallery-card__preview">
                                <a href="/artist/{{$artist['id']}}"> 
                                    <img src="{{$artist['image']}}" alt="">
                                </a>
                            </div>
                          <div class="gallery-card__artist">
                              <div class="artist-name"><span>{{$artist['name']}} {{$artist['surname']}}</span></div>
                              <div class="add-to-wish-list wishlist-artist pointer" data-favorite="{{(int)$artist['is_favorite']}}" data-id="{{$artist['id']}}">
                                  <img src="{{ $artist['is_favorite'] ? asset('img/new-collection/like_red.svg') : asset('img/new-collection/like.svg') }}" data-toggledsrc="{{ $artist['is_favorite'] ? asset('img/new-collection/like.svg') : asset('img/new-collection/like_red.svg') }}" alt="">
                            </div>
                          </div>
                          <div class="gallery-card__date-registration">{{$translates['on_site']}}: {{$artist['duration']}}</div>
                          <div class="gallery-card__style">
                              <div class="style__wrapper">
                                  <i class="icon-style"></i>
                                  {{$translates['style']}}
                              </div>
                              <div class="custom-select" style="width: 100%">
                                  <div class="custom-select__arrow">
                                      <img src="{{asset('img/artist-portfolio/arrow-rounding.svg')}}" alt="">
                                  </div>
                                  <select>
                                    <option value="0"> {{$translates['styles']}}: {{count($artist['styles'])}}</option>
                                      @foreach ($artist['styles'] as $id => $style)
                                        <option value="{{$id}}">{{$style}}</option>
                                    @endforeach
                                  </select>
                              </div>
                          </div>
                          <div class="gallery-card__rating">
                             <div class="rating__wrapper"> <i class="icon-rating"></i> {{$translates['rating']}}</div>
                              <span>{{$artist['rating']}} {{$translates['of']}} 5</span>
                          </div>
                          <div class="gallery-card__deal">
                              <div class="deal__wrapper">
                                  <i class="icon-ckecked"></i>
                                  {{$translates['completed_transactions']}}
                              </div>
                              <span>13</span>
                          </div>
                          <div class="gallery-card__executor">
                              <div class="executor__wrapper">
                                  <i class="icon-competition"></i>
                                  {{$translates['selected_by_performer']}}
                              </div>
                              <span>19</span>
                          </div>
                          <div class="gallery-card__reviews">
                              <div class="reviews__wrapper">
                                  <i class="icon-reviews"></i>
                                  {{$translates['reviews']}}
                              </div>
                              <span>3</span>
                          </div>
                          <div class="gallery-card__order">
                              <div class="btn--order"><a href="/meeting-order/{{$artist['id']}}">{{$translates['propose_order']}}</a></div>
                          </div>
                      </div>
                    </div>

                @endforeach

              </div>
          </div>
      </div>
  </section>
	
	<!-- Load CSS -->
	
    <link rel="stylesheet"  href="{{asset('css/normalize.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/fonts.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/header-lk.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/lk-1.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/footer-lk.css')}}" />
	<!-- Load Scripts -->
    <script src="{{asset('libs/anime.min.js')}}"></script>
    <script src="{{asset('js/plugins-lk.js')}}"></script>
    <script src="{{ asset('js/server.js') }}"></script>
    <script src="{{ asset('js/common.js') }}"></script>
  <script>


  </script>
@endsection

@include('layouts.footer_account')