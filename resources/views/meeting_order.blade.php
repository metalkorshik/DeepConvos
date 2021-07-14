@include('layouts.header_account')

@section('content')

    @include('layouts.aside')
    @yield('aside')
	
  <section class="main-area">
      <div class="main-area__inner">
          <form class="customer-message" method="POST" action="{{$action}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="is-male-input" name="is_male" value="{{$is_male_clothes ? '1' : '0'}}"/>
            <input type="hidden" id="send-sketches" name="send_sketches" value="{{isset($meeting_info) && $meeting_info['send_sketches_before'] ? '1' : ''}}"/>
            <input type="hidden" name="artist_id" value="{{$artist['id']}}"/>
            <input type="hidden" name="meeting_id" value="{{isset($meeting_info) ? $meeting_info['id'] : '0'}}"/>
            <input type="hidden" name="is_free_edit" value="{{isset($meeting_info) ? $meeting_info['is_free_edit'] : '0'}}"/>
            
            @if(isset($meeting_info))
                <input type="hidden" name="meeting_id" value="{{$meeting_info['id']}}"/>
            @endif

              <div class="link-back-to-artists">
                  <a href="/artists">
                      <i class="icon-arrow-slide-left"></i>
                      {{$translates['back_to_performers']}}
                  </a>
              </div>
              <div class="suggest-order">
                {{$translates['propose_order']}}
              </div>
              <div class="painter">
                  <div class="painter__item">
                    {{$translates['artist']}}
                  </div>
                  <div class="painter__item">
                      <img class="painter-small-avatar" src="{{$artist['image']}}" alt="">
                      <p>{{$artist['name']}} {{$artist['surname']}}</p>
                  </div>
              </div>
              <div class="make-appointment">
                  <div class="make-appointment__item">{{$translates['make_appointment_at']}}:</div>
                  <div class="make-appointment__item">
                      <input id="datepicker" required autocomplete="off" name="date" type="text" placeholder="_ . _ . 2020" value="{{isset($meeting_info) ? $meeting_info['date'] : ''}}">
                      <div class="calendar-image">
                          <a href="#">  <img src="{{asset('img/lk-images/calendar.svg')}}" alt=""></a>
                      </div>
                  </div>
              </div>
              <div class="clothes">
                  <div class="clothes__item">{{$translates['clothes_for']}}:</div>
                  <div class="clothes__item">
                      <ul>
                          <li>
                              <label class="container">{{$translates['women']}}
                                  <input class="gender-radio" data-gender="0" type="radio" {{$is_male_clothes ? '' : 'checked="checked"' }} name="gender-radio">
                                  <span class="checkmark"></span>
                              </label>
                          </li>
                          <li>
                              <label class="container">{{$translates['men']}}
                                  <input class="gender-radio" data-gender="1" type="radio" {{$is_male_clothes ? 'checked="checked"' : '' }} name="gender-radio">
                                  <span class="checkmark"></span>
                              </label>
                          </li>
                      </ul>
                  </div>
              </div>
              <div class="letter-title">
                  <div class="letter-title__item">{{$translates['letter_header']}}</div>
                  <div class="letter-title__item"><input type="text" name="order_title" required placeholder="{{$translates['enter_your_text']}}" value="{{isset($meeting_info) ? $meeting_info['title'] : ''}}"></div>
              </div>
              <div class="task-description">
                  <div class="task-description__item">
                    {{$translates['task']}}
                  </div>
                  <div class="task-description__item">
                      <div class="area-wrapper">
                          <textarea name="order_description" required cols="30" rows="4" placeholder="{{$translates['describe_your_order']}}">{{isset($meeting_info) ? $meeting_info['description'] : ''}}</textarea>
                          <div class="loaded">
                              <label for="file-upload">
                                  <div class="load-item"><img src="{{asset('img/lk-images/icons-clip.svg')}}" alt=""></div>
                              </label>
                              <input id="file-upload" name="attachments[]" multiple="multiple" type="file">
                          </div>
                      </div>
                        <div id="uploaded-meeting-files" class="uploaded-files-block">
                            {{-- @if(isset($meeting_info))

                                @foreach ($meeting_info['attachments'] as $attachment)
                                    <div class="uploaded-file-block"><span>{{$attachment['name']}}</span></div>
                                @endforeach

                            @endif --}}
                        </div>
                     <div class="checkbox-item">
                         <div class="checkbox__line">
                             <div class="checkbox">
                                 <input class="cb" type="checkbox" id="send-sketches-checkbox" {{isset($meeting_info) && $meeting_info['send_sketches_before'] ? 'checked' : ''}}>
                                 <label for="send-sketches-checkbox">{{$translates['ask_send_sketches']}}</label>
                             </div>
                         </div>
                     </div>
                      <div class="enter-to-payment">
                          <button class="btn--payment"><a>{{$translates['go_meeting_payment']}}</a></button>
                      </div>
                  </div>
              </div>

            </form>
      </div>
  </section>
	
	<!-- Load CSS -->

    <link rel="stylesheet"  href="{{asset('css/normalize.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/fonts.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/header-lk.css')}}" />
    <link rel="stylesheet" href="{{asset('css/jquery-ui.c')}}ss">
	<link rel="stylesheet"  href="{{asset('css/lk.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/footer-lk.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.css" integrity="sha512-LT9fy1J8pE4Cy6ijbg96UkExgOjCqcxAC7xsnv+mLJxSvftGVmmc236jlPTZXPcBRQcVOWoK1IJhb1dAjtb4lQ==" crossorigin="anonymous" />

	<!-- Load Scripts -->
    <script src="{{asset('libs/anime.min.js')}}"></script>
    <script src="{{asset('js/plugins-lk.js')}}"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.js" integrity="sha512-s5u/JBtkPg+Ff2WEr49/cJsod95UgLHbC00N/GglqdQuLnYhALncz8ZHiW/LxDRGduijLKzeYb7Aal9h3codZA==" crossorigin="anonymous"></script>
  <script>
       $( function() {
        var myControl = {
	create: function(tp_inst, obj, unit, val, min, max, step){
		$('<input class="ui-timepicker-input" value="'+val+'" style="width:50%">')
			.appendTo(obj)
			.spinner({
				min: min,
				max: max,
				step: step,
				change: function(e,ui){
					if(e.originalEvent !== undefined)
						tp_inst._onTimeChange();
					tp_inst._onSelectHandler();
				},
				spin: function(e,ui){
					tp_inst.control.value(tp_inst, obj, unit, ui.value);
					tp_inst._onTimeChange();
					tp_inst._onSelectHandler();
				}
			});
		return obj;
	},
	options: function(tp_inst, obj, unit, opts, val){
		if(typeof(opts) == 'string' && val !== undefined)
			return obj.find('.ui-timepicker-input').spinner(opts, val);
		return obj.find('.ui-timepicker-input').spinner(opts);
	},
	value: function(tp_inst, obj, unit, val){
		if(val !== undefined)
			return obj.find('.ui-timepicker-input').spinner('value', val);
		return obj.find('.ui-timepicker-input').spinner('value');
	}
};

            $( "#datepicker" ).datetimepicker({controlType: myControl});

            $('.gender-radio').change(function() {
                $('#is-male-input').val(this.dataset.gender);
            });

            $('#send-sketches-checkbox').change(function() {
                $('#send-sketches').val(this.checked ? 1 : 0);
            });

            $('#file-upload').change(function(e) {
                let files = this.files;
                let uploadBlock = document.getElementById('uploaded-meeting-files');

                for(let i = 0; i < files.length; ++i)
                {
                    let fileBlock = document.createElement('div');
                    let fileName = document.createElement('span');
                    // let removeBtn = document.createElement('img');

                    fileBlock.classList.add('uploaded-file-block');
                    fileBlock.dataset.file = JSON.stringify(files[i]);
                    fileName.textContent = files[i].name;

                    fileBlock.appendChild(fileName);
                    // fileBlock.appendChild(removeBtn);
                    uploadBlock.appendChild(fileBlock);
                }
            });
       } );
  </script>
@endsection

@include('layouts.footer_account')