@include('layouts.header_account')

@section('content')

    @include('layouts.aside')
    @yield('aside')
	
  <section class="main-area">
      <div class="main-area__inner">
          <div class="customer-meeting">
              <div class="customer-meeting__title">
                {{$translates['meetings']}}
              </div>
              <div class="customer-meeting__table">
                  <div class="table__item">
                      <div class="item__top">
                          <div class="top__title">{{$translates['product']}}</div>
                          <div class="top__title">{{$translates['meeting_date_time']}}</div>
                      </div>

                      @foreach ($meetings as $meeting)
                          
                        <div class="item__data">
                            <div class="data__element">{{$meeting['title']}}</div>
                            <div class="data__element"><i class="icon-table-calendar"></i><span>{{$meeting['date']}}</span> <i class="icon-table-clock"></i>{{$meeting['time']}}</div>
                        </div>

                      @endforeach
                  </div>
                  <div class="table__item">
                      <div class="item__top">
                          <div class="top__title">{{$translates['meeting_time_remains']}}</div>
                          <div class="top__title">{{$translates['platform']}}</div>
                      </div>

                      @foreach ($meetings as $meeting)
                          
                        <div class="item__data">
                            <div class="data__element"><i class="icon-table-timer active--timer"></i>{{$meeting['days_remains'] != 0 ? $meeting['days_remains'] . ' ' . $translates['d'] : '' }} {{$meeting['hours_remains'] != 0 ? $meeting['hours_remains'] . ' ' . $translates['h'] : '' }} {{$meeting['minutes_remains']}} {{$translates['m']}}</div>
                            <div class="data__element"><i class="icon-table-zoom"></i></div>
                        </div>

                      @endforeach
                    
                  </div>
                  <div class="table__item">
                      <div class="item__top">
                          <div class="top__title">{{ $user_info['is_artist'] ? $translates['customer'] : $translates['artist'] }}</div>
                      </div>

                      @foreach ($meetings as $meeting)
                          
                        <form class="item__data meeting-actions-form-{{$meeting['id']}}" method="POST">
                            @csrf
                            <input type="hidden" name="meeting_id" value="{{$meeting['id']}}"/>
                            <div class="data__element"><img class="artist-avatar" src="{{ $user_info['is_artist'] ? $meeting['customer']['image'] : $meeting['artist']['image'] }}" alt=""><span>{{ $user_info['is_artist'] ? $meeting['customer']['full_name'] : $meeting['artist']['full_name'] }}</span></div>
                            @if(!$user_info['is_artist'])
                                <div class="data__element">
                                    <div class="btn--change pointer" data-id="{{$meeting['id']}}">
                                        <a>{{$translates['change']}}</a>
                                    </div> 
                                    <div class="btn--cancel pointer" data-id="{{$meeting['id']}}">
                                        <a>{{$translates['cancel']}}</a>
                                    </div>
                                </div>
                            @endif
                        </form>
                        
                      @endforeach

                  </div>
              </div>
          </div>
      </div>
  </section>
	
	<!-- Load CSS -->
	
        <link rel="stylesheet"  href="{{asset('css/normalize.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/fonts.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/header-lk.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/lk-10.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/footer-lk.css')}}" />
	<!-- Load Scripts -->
    <script src="{{asset('libs/anime.min.js')}}"></script>
    <script src="{{asset('js/plugins-lk.js')}}"></script>
  <script>

    let changeButtons = document.querySelectorAll('.btn--change');
    let cancelButtons = document.querySelectorAll('.btn--cancel');
    
    for (let index = 0; index < changeButtons.length; index++) {

        changeButtons[index].addEventListener('click', function(e) {

            let form = document.querySelector('.meeting-actions-form-' + this.dataset.id);
            form.action = '/meeting-order';
            form.submit();

        });

    }

    for (let index = 0; index < cancelButtons.length; index++) {

        cancelButtons[index].addEventListener('click', function(e) {

            if(confirm(`{{$translates['are_you_sure']}}`))
            {
                let form = document.querySelector('.meeting-actions-form-' + this.dataset.id);
                form.action = '/cancel-meeting';
                form.submit();
            }        

        });

    }

  </script>
@endsection

@include('layouts.footer_account')
