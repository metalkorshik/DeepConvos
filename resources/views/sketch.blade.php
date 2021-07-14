@include('layouts.header_account')

@section('content')

    @include('layouts.aside')
    @yield('aside')

    @include('layouts.sketch_forms')
    @yield('sketch_forms')

    <section class="modal-section">
      <div class="modal-overlay"></div>
      <div  class="form-popup sketch-form">
           <div class="close-form"><i class="icon-close"></i></div>
          <div class="sketch-form__title">{{$translates['revision_sketch_comment']}}</div>
         <div class="sketch-form__wrapper">
             <textarea name="msg" id="" cols="30" rows="10" placeholder="{{$translates['enter_your_text']}}"></textarea>
             <div class="loaded">
                 <label for="file-upload">
                     <div class="load-item"><img src="{{asset('img/lk-images/icons-clip.svg')}}" alt=""></div>
                 </label>
                 <input id="file-upload" type="file">
             </div>
         </div>
         <div class="sketch-form__description">
            {{$translates['attached']}} <span>2 {{$translates['files']}}</span>  <span>Primer1.jpg</span>
         </div>
          <div class="button-wrapper">
              <button class="btn-send-1" type="submit">{{$translates['send']}}</button>
          </div>

      </div>
      <div class="form-popup sketch-canceling-form">
          <div class="close-form"><i class="icon-close"></i></div>
          <div class="sketch-canceling-form__title">{{$translates['cancel_order']}}</div>
          <div class="sketch-canceling-form__description">{{$translates['order_cancel_comission_of']}} 
              <br>{{$translates['sure_cancel_order']}} </div>
          <div class="sketch-canceling-form__order">
            {{$translates['send_order_on_revision']}}
          </div>
          <div class="sketch-canceling-form__button-wrapper">
              <div class="btn--send"><a href="/sketches">{{$translates['yes_cancel_order']}}</a></div>
              <div class="btn--canceling"><a href="/sketches">{{$translates['no_change_my_mind']}}</a></div>
          </div>
      </div>
      <div class="form-popup sketch-submit-form">
          <div class="close-form"><i class="icon-close"></i></div>
          <div class="sketch-submit-form__title">{{$translates['thanks_message_sent']}}</div>
          <img src="{{asset('img/lk-images/form-image.svg')}}" alt="">
          <div class="sketch-submit-form__description">{{$translates['you_make_service_better']}}</div>
      </div>
      <div class="form-popup sketch-cause">
          <div class="close-form"><i class="icon-close"></i></div>
          <div class="sketch-cause__title">{{$translates['your_order_cancelled']}}</div>
          <div class="sketch-cause__description">{{$translates['tell_why_cancel_order']}}
            {{$translates['help_improve_service']}}</div>
          <ul>
              <li>
                  <label class="container">{{$translates['artist_style_did_not_fit']}}
                      <input type="radio" checked="checked" name="radio">
                      <span class="checkmark"></span>
                  </label>
              </li>
              <li>
                  <label class="container">{{$translates['bad_work_approach']}}
                      <input type="radio" name="radio">
                      <span class="checkmark"></span>
                  </label>
              </li>
              <li>
                  <label class="container">{{$translates['not_revelant']}}
                      <input type="radio" name="radio">
                      <span class="checkmark"></span>
                  </label>
              </li>
          </ul>
          <textarea name=""  cols="30" rows="10" placeholder="{{$translates['discribe_your_problem']}}"></textarea>
          <div class="sketch-cause__send-button">
              <button type="submit">{{$translates['send']}}</button>
          </div>
      </div>
  </section>
  
  <section class="main-area">
      <form class="main-area__inner" id="sketch-form-{{$sketch['id']}}" method="POST" action="/send-sketch" enctype="multipart/form-data">
        @csrf
        <input type="file" multiple class="hidden" id="attachments-upload" name="attachments[]">
        <input type="hidden" name="sketch_id" value="{{$sketch['id']}}">
        <input type="hidden" id="is-artist" value="{{$is_artist}}">
          <div class="customer-sketches">
              <div class="link-back-to-sketches">
                  <a href="/sketches">
                      <i class="icon-arrow-slide-left"></i>
                      {{$translates['back_to_sketches']}}
                  </a>
              </div>
              <div class="customer-sketches__title">
                {{$translates['sent_sketches']}}
              </div>
              <div class="customer-sketches__artist">
                <img src="{{$is_artist ? $sketch['customer']['image'] : $sketch['artist']['image']}}" style="width: 40px; height: 40px;" alt=""> 
                {{$is_artist ? $sketch['customer']['full_name'] : $sketch['artist']['full_name']}}
              </div>
              @if($is_artist)
                <div class="b-distance">{{ $translates['sketch_deadline_remains'] }} {{$sketch['days_remains'] != 0 ? $sketch['days_remains'] . ' ' . $translates['d'] : '' }} {{$sketch['hours_remains'] != 0 ? $sketch['hours_remains'] . ' ' . $translates['h'] : '' }} {{$sketch['minutes_remains']}} {{$translates['m']}}</div>
              @endif
              @if($is_artist)    
                  <input name="sketch_title" required type="text" value="{{$sketch['title']}}"/>
              @else
                  <div class="customer-sketches__product">{{$sketch['title']}}</div>
              @endif
              <div class="customer-sketches__actions">
                @if (!$is_artist && !$sketch['is_primary'])
                    <div class="btn--accept accept-sketch-btn pointer" data-id="{{$sketch['id']}}" data-action="{{$actions['accept']}}"><a>{{$translates['accept_sketch']}}</a></div>
                    @if($sketch['is_revisionable'])
                      <div class="btn--revision btn-revision-sketch" data-id="{{$sketch['id']}}" data-action="{{$actions['revision']}}"><a class="revision-sketch-btn pointer">{{$translates['revision']}}</a></div>
                    @endif
                    <div class="btn--cancel btn-cancel-sketch" data-id="{{$sketch['id']}}"><a class="cancel-sketch-btn pointer" data-id="{{$sketch['id']}}" data-action="{{$actions['cancel']}}">{{$translates['cancel']}}</a></div>
                @endif
              </div>
              <div class="customer-sketches__gallery">
                  <div class="container">
                      <div class="swiper-button-next"><i class="icon-arrow-slide-right"></i></div>
                      <div class="swiper-button-prev"><i class="icon-arrow-slide-left"></i></div>
                      <div class="swiper-container">
                          <div class="swiper-wrapper" id="attachments-block">
                            @foreach ($sketch['attachments'] as $attachment)
                                <div class="swiper-slide"><div class="slider-inner"><img src="{{$attachment['file']}}" alt=""></div></div>
                            @endforeach
                          </div>

                      </div>
                      <div class="slider-description">
                          <span>
                            <span id="attachments-count">{{count($sketch['attachments'])}}</span> 
                            {{$translates['files']}}
                          </span>
                          @if ($is_artist)
                            <a class="pointer" id="upload-btn">{{$translates['upload']}}</a>
                          @else
                            <a class="download-sketch-btn pointer" data-id="{{$sketch['id']}}" data-action="{{$actions['download']}}">
                              {{$translates['download']}}
                            </a>
                          @endif
                      </div>
                  </div>

              </div>
              <div class="customer-sketches__comments col-block">

                  @if($is_artist)    

                  @if(isset($sketch['revision']))
                    <div class="comments__title">{{$translates['revision_sketch_comment']}}</div>
                    <div class="comments__description">{{$sketch['revision']['comment']}}</div>
                    <div style="margin-top: 10px;">
                      @foreach ($sketch['revision']['attachments'] as $attachment)
                        <img style="width: 100px;" src="{{$attachment['file']}}"/>
                      @endforeach
                    </div>
                  @endif
                    <div class="comments__title">{{$translates['artist_comment']}}</div>
                    <textarea name="comment"></textarea>
                    <div class="comments__title">{{$translates['technique']}}</div>
                    <input name="technique" required type="text" value="{{$sketch['technique']}}"/>

                  @else

                    <div class="comments__title">{{$translates['artist_comment']}}</div>
                    <div class="comments__description">{{$sketch['comment']}}</div>
                    <div class="comments__title">{{$translates['technique']}}</div>
                    <div class="comments__description">{{$sketch['technique']}}</div>

                  @endif

                  @if($is_artist && $sketch['is_first_sketch'])    
                    <div class="comments__title">{{$translates['amount']}}, €:</div> <input required name="order_amount" type="text" value="{{$sketch['order_amount']}}"/>
                  @else
                    <div class="comments__title">{{$translates['amount']}}:</div> {{$sketch['order_amount']}} €
                  @endif
              </div>
              <div class="customer-sketches__actions">
                @if ($is_artist)
                    <button class="btn--accept pointer custom-btn" style="margin-top: 40px;"><a>{{$translates['save']}}</a></button>
                @endif
              </div>
          </div>
        </form>
  </section>

	<!-- Load CSS -->
	
    <link rel="stylesheet"  href="{{asset('css/normalize.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/fonts.css')}}" />
    <link rel="stylesheet"  href="{{asset('css/swiper.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/header-lk.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/lk-6.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/lk-12.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/footer-lk.css')}}" />
	<!-- Load Scripts -->
    <script src="{{asset('libs/anime.min.js')}}"></script>
    <script src="{{asset('js/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('js/server.js')}}"></script>
    <script src="{{asset('js/plugins-lk.js')}}"></script>
  <script>

    let isArtist = document.getElementById('is-artist').value;

    if(isArtist == 1)
    {
      document.getElementById('upload-btn').addEventListener('click', e => {
        document.getElementById('attachments-upload').click();
      });

      document.getElementById('attachments-upload').addEventListener('change', function(e) {

        var uploadBlock = document.getElementById('attachments-block');
        document.getElementById('attachments-count').textContent = this.files.length;

        if (this.files) 
            [].forEach.call(this.files, readAndPreview);

        function readAndPreview(file) {

            var reader = new FileReader();

            reader.addEventListener("load", function() {

              let swiper = document.createElement('div');
              swiper.classList.add('swiper-slide');
              let slider = document.createElement('div');
              slider.classList.add('slider-inner');
              let img = document.createElement('img');
              img.src = this.result;
              slider.appendChild(img);
              swiper.appendChild(slider);
              uploadBlock.appendChild(swiper);
            });
            
            reader.readAsDataURL(file);

        }

      });
    }

       let swiper50 = new Swiper('.customer-sketches__gallery .swiper-container', {
            navigation: {
                 nextEl: '.customer-sketches__gallery .container .swiper-button-next',
                 prevEl: '.customer-sketches__gallery .container .swiper-button-prev',
            },
            breakpoints: {
                 460: {
                      slidesPerView: 2,
                      spaceBetween: 10,
                 },

                 800: {
                      slidesPerView: 3,
                      spaceBetween: 10,
                 },
                 1366: {
                      slidesPerView: 5,
                      spaceBetween: 16,
                 },
            }
       });


  </script>
@endsection

@include('layouts.footer_account')