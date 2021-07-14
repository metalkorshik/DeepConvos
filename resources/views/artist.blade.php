@include('layouts.header_main')

@section('content')
	
   <section class="artists-inner">
      <div class="artists-inner__container">
          <div class="artists-inner__content">
              <ul class="breadcrumbs">
                  <li><a href="/">Главная</a></li>
                  <li><a href="/artists">Художники </a></li>
                  <li><a href="/artist">{{$artist['name']}} {{$artist['surname']}}</a></li>
              </ul>
          </div>
      </div>
   </section>

  <section class="artists-primary">
      <div class="artists-primary__container">
          <div class="artists-primary__content">
              <div class="content__artist-description">
                  <div class="artist-description__inner">
                    @if(Auth::check())
                         <div class="artist-description__to-wish-list wishlist-artist pointer" data-favorite="{{(int)$artist['is_favorite']}}" data-id="{{$artist['id']}}">
                              <img src="{{ $artist['is_favorite'] ? asset('img/new-collection/like_red.svg') : asset('img/new-collection/like.svg') }}" data-toggledsrc="{{ $artist['is_favorite'] ? asset('img/new-collection/like.svg') : asset('img/new-collection/like_red.svg') }}" alt="">
                         </div>
                    @endif
                    <div class="user-form__link-back">
                         <a href="{{url('/')}}"><i class="icon-arrow-slide-left"></i>{{$translates['back']}}</a>
                     </div>
                      <div class="artist-description__photo">
                          <div class="photo__item"><img src="{{$artist['image']}}" alt=""></div>
                      </div>
                      <div class="artist-description__name">{{$artist['name']}} {{$artist['surname']}}</div>
                      <div class="artist-description__date-registration">{{$translates['on_site']}}: <span> {{$artist['duration']}}</span></div>
                      <div class="artist-description__age">{{$translates['age']}}: <span> {{$artist['age']}}</span></div>
                      <div class="artist-description__education">{{$translates['education']}}: <span> {{$artist['education']}}</span></div>
                      <div class="artist-description__education-additionally">{{$translates['additional_education']}}: <span> {{$artist['additional_education']}}</span></div>
                      <div class="artist-description__contests">{{$translates['participation']}}: <span> {{$artist['participation']}}</span></div>
                      <div class="artist-description__style">{{$translates['style']}}: <span>{{$artist['styles_text']}}</span></div>
                      <div class="artist-description__style-description">{{$artist['style_info']}}</div>
                      <div class="artist-description__technique">{{$translates['technique']}}: <span>{{$artist['technique']}}</span></div>
                      <div class="artist-description__about">{{$translates['about_me']}}: <span> {{$artist['about']}}</span></div>
                      <div class="artist-description__about">{{$translates['portfolio']}}: </div>
                      <div class="artist-description__images">
                         @foreach ($artist['portfolios'] as $portfolio)
                             <img class="artist-portfolio-img" src="{{$portfolio['file']}}" alt="">
                        @endforeach
                    </div>
                    <div class="artist-description__images col-block">
                         @foreach ($artist['participations'] as $participation)
                             <a href="{{$participation['file']}}" target="_blank">{{$participation['name']}}</a>
                        @endforeach
                    </div>
                      <div class="artist-description__rating">
                          <div class="rating__inner">
                              <i class="icon-rating"></i>
                              {{$translates['rating']}}
                          </div>
                           <span>{{$artist['rating']}} {{$translates['of']}} 5</span>
                      </div>
                      <div class="artist-description__deal">
                          <div class="deal__inner">
                              <i class="icon-ckecked"></i>
                              {{$translates['completed_transactions']}}
                          </div>
                         <span>3</span>
                      </div>
                      <div class="artist-description__executor">
                          <div class="executor__inner">
                              <i class="icon-competition"></i>
                              {{$translates['selected_by_performer']}}
                          </div>
                          <span>3</span>
                      </div>
                      <div class="artist-description__reviews">
                        <div class="reviews__inner">
                            <i class="icon-reviews"></i>
                            {{$translates['reviews']}}
                        </div>
                        <span>3</span>

                      </div>
                      <form class="artist-description__order" method="POST" action="/meeting-order">
                           @csrf
                           <input type="hidden" name="artist_id" value="{{$artist['id']}}"/>
                          <button class="btn--order custom-btn"><a>{{$translates['propose_order']}}</a></button>
                      </form>
                  </div>
               </div>
              <div class="content__artist-works">
                  <div class="artist-works__title">
                      <h2>{{$translates['artist_works']}}</h2>
                  </div>
                  <div class="artist-works__filter">

                      <div class="custom-select" >
                          <div class="custom-select__arrow">
                              <img src="{{asset('img/artist-portfolio/arrow-rounding.svg')}}" alt="">
                          </div>
                          <select>
                               @foreach ($artist['styles'] as $id => $style)
                                   <option value="{{$id}}">{{$style}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>
                  <div class="artist-works__works">

                    @for ($i = 0; $i < 10; ++$i)
                      <div class="works__item">
                          <img src="{{asset('img/artist-inner/image-22.jpg')}}" alt="">
                          <div class="item__link"><a href="/artist-work">{{$translates['show_project']}}</a></div>
                      </div>
                    @endfor
                    
                  </div>

              </div>
          </div>
      </div>
  </section>

	<!-- Load CSS -->
	
    <link rel="stylesheet"  href="{{asset('css/normalize.css')}}" />
     <link rel="stylesheet"  href="{{asset('css/swiper.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/fonts.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/header2.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/main4.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/footer.css')}}" />

	<!-- Load Scripts -->
	 <script src="{{asset('libs/jquery-3.3.1/smothscroll.js')}}"></script>
     <script src="{{asset('libs/jquery-3.3.1/rellax.min.js')}}"></script>
      <script src="{{asset('libs/anime.min.js')}}"></script>
     <script src="{{asset('js/swiper-bundle.min.js')}}"></script>
<!--     <script src="js/plugins1.js"></script>-->
     <script src="{{ asset('js/server.js') }}"></script>
     <script src="{{ asset('js/common.js') }}"></script>
  <script>
       function loadImg() {
            let images = document.getElementsByTagName('img');
            for (let i = 0; i < images.length; i++) {
                 let src = images[i].dataset.src;
                 if (src) {
                      images[i].src = src;
                 }
            }
       }
       window.addEventListener("load", loadImg);

       function mobileOpen() {

            let burger = document.querySelector('.menu-icon-wrapper');
            let mobileMenu = document.querySelector('.mobile-navigation');
            let k = 0;
            burger.addEventListener('click', function () {
                 k++;
                 if (k === 1) {
                      mobileMenu.style.display = 'block';
                      setTimeout(function () {
                           anime({
                                targets: mobileMenu,
                                translateY:  ['-100%','0'],
                                duration: 500,
                                easing: 'easeInQuad'
                           });
                      },150)


                 } else if (k === 2) {
                      setTimeout(function () {
                           anime({
                                targets: mobileMenu,
                                translateY:  ['0','-100%'],
                                duration: 500,
                                easing: 'easeInQuad',
                                complete:function () {
                                     mobileMenu.style.display = 'none';
                                }
                           });
                      },50);
                      k=0;
                 }
            });

       }
       mobileOpen();

       {
            document.querySelector('.menu-icon-wrapper').onclick = function(){
                 document.querySelector('.menu-icon').classList.toggle('menu-icon-active');
            };
       }
       var x, i, j, l, ll, selElmnt, a, b, c;
       /*look for any elements with the class "custom-select":*/
       x = document.getElementsByClassName("custom-select");
       l = x.length;
       for (i = 0; i < l; i++) {
            selElmnt = x[i].getElementsByTagName("select")[0];
            ll = selElmnt.length;
            /*for each element, create a new DIV that will act as the selected item:*/
            a = document.createElement("DIV");
            a.setAttribute("class", "select-selected");
            a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
            x[i].appendChild(a);
            /*for each element, create a new DIV that will contain the option list:*/
            b = document.createElement("DIV");
            b.setAttribute("class", "select-items select-hide");
            for (j = 1; j < ll; j++) {
                 /*for each option in the original select element,
                 create a new DIV that will act as an option item:*/
                 c = document.createElement("DIV");
                 c.innerHTML = selElmnt.options[j].innerHTML;
                 c.addEventListener("click", function(e) {
                      /*when an item is clicked, update the original select box,
                      and the selected item:*/
                      var y, i, k, s, h, sl, yl;
                      s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                      sl = s.length;
                      h = this.parentNode.previousSibling;
                      for (i = 0; i < sl; i++) {
                           if (s.options[i].innerHTML == this.innerHTML) {
                                s.selectedIndex = i;
                                h.innerHTML = this.innerHTML;
                                y = this.parentNode.getElementsByClassName("same-as-selected");
                                yl = y.length;
                                for (k = 0; k < yl; k++) {
                                     y[k].removeAttribute("class");
                                }
                                this.setAttribute("class", "same-as-selected");
                                break;
                           }
                      }
                      h.click();
                 });
                 b.appendChild(c);
            }
            x[i].appendChild(b);
            a.addEventListener("click", function(e) {
                 /*when the select box is clicked, close any other select boxes,
                 and open/close the current select box:*/
                 e.stopPropagation();
                 closeAllSelect(this);
                 this.nextSibling.classList.toggle("select-hide");
                 this.classList.toggle("select-arrow-active");
            });
       }
       function closeAllSelect(elmnt) {
            /*a function that will close all select boxes in the document,
            except the current select box:*/
            var x, y, i, xl, yl, arrNo = [];
            x = document.getElementsByClassName("select-items");
            y = document.getElementsByClassName("select-selected");
            xl = x.length;
            yl = y.length;
            for (i = 0; i < yl; i++) {
                 if (elmnt == y[i]) {
                      arrNo.push(i)
                 } else {
                      y[i].classList.remove("select-arrow-active");
                 }
            }
            for (i = 0; i < xl; i++) {
                 if (arrNo.indexOf(i)) {
                      x[i].classList.add("select-hide");
                 }
            }
       }
       /*if the user clicks anywhere outside the select box,
       then close all select boxes:*/
       document.addEventListener("click", closeAllSelect);
       let select = document.querySelectorAll('.select-selected');
       let icons = document.querySelectorAll('.custom-select__arrow');
       for (let i = 0; i <select.length ; i++) {
            for (let j = 0; j <icons.length ; j++) {
                 let k = 0;
                 select[i].addEventListener('click', function () {
                      k++;
                      if (k === 1) {
                           icons[i].classList.add('active-icon');
                      } else if (k === 2) {
                           icons[i].classList.remove('active-icon');
                           k=0;
                      }
                 })
            }
       }

  </script>
@endsection

@include('layouts.footer_main')