@section('sketch_forms')

  <section class="main-area hidden">
      <div class="main-area__inner">
          <div class="sample-buttons">
              <button class="btn" id="btn-comment-cancel-sketch" data-canceled="{{$canceled ?? false}}"></button>
          </div>
      </div>
  </section>

  <section class="modal-section">
      <div class="modal-overlay"></div>
      <form class="form-popup sketch-form" method="POST" action="/revision-sketch" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="revision-sketch-id" name="sketch_id">
           <div class="close-form"><i class="icon-close"></i></div>
          <div class="sketch-form__title">{{$translates['revision_sketch_comment']}}</div>
         <div class="sketch-form__wrapper">
             <textarea name="comment" required id="" cols="30" rows="10" placeholder="{{$translates['enter_your_text']}}"></textarea>
             <div class="loaded">
                 <label for="revision-attachmnt-file-upload">
                     <div class="load-item"><img src="{{asset('img/lk-images/icons-clip.svg')}}" alt=""></div>
                 </label>
                 <input type="file" id="revision-attachmnt-file-upload" multiple name="attachments[]">
             </div>
         </div>
         <div class="sketch-form__description">
            {{$translates['attached']}} 
            <span>
                <span id="count-attached-revision-files">0</span> 
                {{$translates['files']}}
            </span>  
            <span id="attached-revision-files"></span>
         </div>
          <div class="button-wrapper">
              <button class="btn-send-1" id="revision-send-btn" type="submit">{{$translates['send']}}</button>
          </div>

      </form>
      <div class="form-popup sketch-canceling-form">
          <div class="close-form"><i class="icon-close"></i></div>
          <div class="sketch-canceling-form__title">{{$translates['cancel_order']}}</div>
          <div class="sketch-canceling-form__description">{{$translates['order_cancel_comission_of']}} 
              <br>{{$translates['sure_cancel_order']}} </div>
          <div class="sketch-canceling-form__order">
            {{$translates['send_order_on_revision']}}
          </div>
          <form class="sketch-canceling-form__button-wrapper" method="POST" action="/cancel-sketch">
            @csrf
            <input type="hidden" id="cancel-form-sketch-id" name="sketch_id">
              <button class="btn--send custom-btn pointer"><a>{{$translates['yes_cancel_order']}}</a></button>
              <div class="btn--canceling pointer" id="deny-sketch-cancelling-btn"><a>{{$translates['no_change_my_mind']}}</a></div>
          </form>
      </div>
      <div class="form-popup sketch-submit-form">
          <div class="close-form" id="close-submit-form"><i class="icon-close"></i></div>
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
              @foreach ($deny_reasons as $reason)
                <li>
                    <label class="container">{{$reason['reason']}}
                        <input type="radio" {{$deny_reasons[0] == $reason ? 'checked' : ''}} class="radio-cancel-sketch-reasons" name="radio-cancel-sketch-reasons" data-id="{{$reason['id']}}">
                        <span class="checkmark"></span>
                    </label>
                </li>
              @endforeach
          </ul>
          <textarea name="" id="cancel-sketch-comment"  cols="30" rows="10" placeholder="{{$translates['discribe_your_problem']}}"></textarea>
          <div class="sketch-cause__send-button">
              <button class="btn-success-message-sketch" id="btn-success-message-sketch" data-order="{{$canceled_order_id ?? 0}}">{{$translates['send']}}</button>
          </div>
      </div>
  </section>
  <script>

    document.getElementById('revision-attachmnt-file-upload').addEventListener('change', function (ev) {

        let files = this.files;
        let names = [];

        for (let index = 0; index < files.length; index++) 
            names.push(files[index].name)

        document.getElementById('count-attached-revision-files').textContent = files.length;
        document.getElementById('attached-revision-files').textContent = names.join(', ');
    });

  </script>
@endsection