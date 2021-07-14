@include('layouts.header_account')

@section('content')

    @include('layouts.aside')
    @yield('aside')
	
  <section class="main-area">
      <form class="main-area__inner" id="updateUserDetailsForm" action="/updateUserDetails" method="POST" enctype="multipart/form-data" style="padding-bottom: 100px;">
        @csrf
          <input type="hidden" name="is_artist" id="is-artist" value="{{$user_info['is_artist']}}"/>
          <div class="customer-data">
                <div class="customer-data__title">{{$translates['my_details']}}</div>
                <div class="customer-data__name">
                    <div class="name__icon" style="{{ isset($user_info['image']) ? 'background-image: url(' . $user_info['image'] . '); background-size: 100% 100%;' : '' }}">
                        <div class="icon__file">
                            <label for="avatar-upload">
                                <div class="load-item">
                                    <img src="{{asset('img/lk-images/pencil.svg')}}" alt="">
                                </div>
                            </label>
                            <input id="avatar-upload" name="avatar" type="file">
                        </div>
                    </div>
                    <div class="name__description">{{ $user_info['name'] . ' ' . $user_info['surname'] }}</div>
                </div>
                <div class="customer-data__line">
                    <div class="line__description">{{$translates['name']}}</div>
                    <div class="input-wrapper">
                        <input class="change" required type="text" name="name" value="{{$user_info['name']}}" readonly>
                        <div class="input-save"><button>{{$translates['save']}}</button></div>
                    </div>
                    <div class="line__button">{{$translates['change']}}</div>
                </div>
                <div class="customer-data__line">
                    <div class="line__description">{{$translates['surname']}}</div>
                    <div class="input-wrapper">
                        <input class="change" required type="text" name="surname" value="{{$user_info['surname']}}" readonly>
                        <div class="input-save"><button>{{$translates['save']}}</button></div>
                    </div>
                    <div class="line__button">{{$translates['change']}}</div>
                </div>
                <div class="customer-data__line">
                    <div class="line__description">E-mail</div>
                    <div class="input-wrapper">
                        <input class="change" required type="text" name="email" value="{{$user_info['email']}}" readonly>
                        <div class="input-save"><button>{{$translates['save']}}</button></div>
                    </div>
                    <div class="line__button">{{$translates['change']}}</div>
                </div>
                <div class="customer-data__line">
                    <div class="line__description">{{$translates['phone']}}</div>
                    <div class="input-wrapper">
                        <input class="change" required type="text" name="phone" value="{{$user_info['phone']}}" readonly>
                        <div class="input-save"><button>{{$translates['save']}}</button></div>
                    </div>
                    <div class="line__button">{{$translates['change']}}</div>
                </div>
                <div class="customer-data__line">
                    <div class="line__description">{{$translates['country']}}</div>
                    <div class="input-wrapper">
                        <input class="change" required type="text" name="country" value="{{$user_info['country']}}" readonly>
                        <div class="input-save"><button>{{$translates['save']}}</button></div>
                    </div>
                    <div class="line__button">{{$translates['change']}}</div>
                </div>
                <div class="customer-data__line">
                    <div class="line__description">{{$translates['city']}}</div>
                    <div class="input-wrapper">
                        <input class="change" required type="text" name="city" value="{{$user_info['city']}}" readonly>
                        <div class="input-save"><button>{{$translates['save']}}</button></div>
                    </div>
                    <div class="line__button">{{$translates['change']}}</div>
                </div>
                @if(!$user_info['is_artist'])
                    <div class="checkbox">
                        <input class="cb" name="is_subscriber" {{$user_info['is_subscriber'] ? 'checked="checked"' : ''}} type="checkbox" id="is-subscriber-checkbox">
                        <label for="is-subscriber-checkbox">{{$translates['subscribe_new_collections']}}</label>
                    </div>
                @endif
                @if($user_info['is_artist'])
                    <div class="customer-data__line">
                        <div class="line__description">{{$translates['birthdate']}}</div>
                        <div class="input-wrapper">
                            <input class="change" required type="text" name="birthdate" value="{{$user_info['birthdate']}}" readonly>
                            <div class="input-save"><button>{{$translates['save']}}</button></div>
                        </div>
                        <div class="line__button">{{$translates['change']}}</div>
                    </div>
                    <div class="customer-data__line">
                        <div class="line__description">{{$translates['card_number']}}</div>
                        <div class="input-wrapper">
                            <input class="change" required type="text" name="card_number" value="{{$user_info['card_number']}}" readonly>
                            <div class="input-save"><button>{{$translates['save']}}</button></div>
                        </div>
                        <div class="line__button">{{$translates['change']}}</div>
                    </div>
                    <div class="customer-data__line">
                        <div class="line__description">{{$translates['card_owner']}}</div>
                        <div class="input-wrapper">
                            <input class="change" required type="text" name="card_owner" value="{{$user_info['card_owner']}}" readonly>
                            <div class="input-save"><button>{{$translates['save']}}</button></div>
                        </div>
                        <div class="line__button">{{$translates['change']}}</div>
                    </div>
                    <div class="customer-data__line">
                        <div class="line__description">{{$translates['validity']}}</div>
                        <div class="input-wrapper">
                            <input class="change" required type="text" name="card_validity" value="{{$user_info['card_validity']}}" readonly>
                            <div class="input-save"><button>{{$translates['save']}}</button></div>
                        </div>
                        <div class="line__button">{{$translates['change']}}</div>
                    </div>
                    <div class="customer-data__line">
                        <div class="line__description">{{$translates['education']}}</div>
                        <div class="input-wrapper">
                            <input class="change" type="text" name="education" value="{{$user_info['education']}}" readonly>
                            <div class="input-save"><button>{{$translates['save']}}</button></div>
                        </div>
                        <div class="line__button">{{$translates['change']}}</div>
                    </div>
                    <div class="customer-data__line">
                        <div class="line__description">{{$translates['additional_education']}}</div>
                        <div class="input-wrapper">
                            <input class="change" type="text" name="additional_education" value="{{$user_info['additional_education']}}" readonly>
                            <div class="input-save"><button>{{$translates['save']}}</button></div>
                        </div>
                        <div class="line__button">{{$translates['change']}}</div>
                    </div>
                    <div class="customer-data__line">
                        <div class="line__description">{{$translates['slogan']}}</div>
                        <div class="input-wrapper">
                            <input class="change" type="text" name="slogan" value="{{$user_info['slogan']}}" readonly>
                            <div class="input-save"><button>{{$translates['save']}}</button></div>
                        </div>
                        <div class="line__button">{{$translates['change']}}</div>
                    </div>
                    <div class="customer-data__line">
                        <div class="line__description">{{$translates['styles']}}</div>
                        <div class="input-wrapper">
                            <select multiple id="artist-styles">
                                @foreach ($styles as $id => $style)
                                    <option {{$style['is_used'] ? 'selected' : ''}} value="{{$id}}">{{$style['value']}}</option>
                                @endforeach
                            </select>
                            <div id="artist-styles-input-save" class="input-save-btn"><button>{{$translates['save']}}</button></div>
                        </div>
                    </div>
                    <div class="customer-data__line">
                        <div class="input-wrapper">
                            <input class="change" type="text" name="style_info" value="{{$user_info['style_info']}}" readonly>
                            <div class="input-save"><button>{{$translates['save']}}</button></div>
                        </div>
                        <div class="line__button">{{$translates['change']}}</div>
                    </div>
                    <div class="customer-data__line">
                        <div class="line__description">{{$translates['technique']}}</div>
                        <div class="input-wrapper">
                            <input class="change" type="text" name="technique" value="{{$user_info['technique']}}" readonly>
                            <div class="input-save"><button>{{$translates['save']}}</button></div>
                        </div>
                        <div class="line__button">{{$translates['change']}}</div>
                    </div>
                    <div class="customer-data__line">
                        <div class="line__description">{{$translates['about_me']}}</div>
                        <div class="input-wrapper">
                            <input class="change" type="text" name="about" value="{{$user_info['about']}}" readonly>
                            <div class="input-save"><button>{{$translates['save']}}</button></div>
                        </div>
                        <div class="line__button">{{$translates['change']}}</div>
                    </div>
                    <div class="customer-data__line">
                        <div class="line__description">{{$translates['participation']}}</div>
                        <div class="input-wrapper">
                            <input class="change" type="text" name="participation" value="{{$user_info['participation']}}" readonly>
                            <div class="input-save"><button>{{$translates['save']}}</button></div>
                        </div>
                        <div class="line__button">{{$translates['change']}}</div>
                    </div>
                    <div class="loaded">
                        <label for="participation-upload">
                            <div class="load-item"><img src="{{asset('img/lk-images/icons-clip.svg')}}" alt=""></div>
                        </label>
                        <input class="file-upload" id="participation-upload" name="participations[]" type="file" multiple>
                    </div>
                    <div id="uploaded-participation-files" class="uploaded-files-block">
                        @foreach ($user_info['participations'] as $id => $file)
                            <div class="uploaded-file-block">
                                <input type="hidden" name="currentParticipations[]" value="{{$id}}"/>
                                <a href="{{$file['file']}}" target="_blank">{{$file['name']}}</a>
                                <img src="{{asset('img/icons/cross-remove.svg')}}" class="remove-btn-icon pointer">
                            </div>
                        @endforeach
                    </div>
                    <div class="input-save-btn input-initial-save-btn" id="input-save-participation-uploads"><button>{{$translates['save']}}</button></div>
                    <div class="customer-data__line" style="margin-top: 40px">
                        <div class="line__description">{{$translates['portfolio']}}</div>
                    </div>
                    <div class="loaded">
                        <label for="portfolio-upload">
                            <div class="load-item"><img src="{{asset('img/lk-images/icons-clip.svg')}}" alt=""></div>
                        </label>
                        <input class="file-upload" id="portfolio-upload" name="portfolios[]" type="file" multiple>
                    </div>
                    <div id="uploaded-portfolio-files" class="uploaded-files-block">
                        @foreach ($user_info['portfolios'] as $id => $file)
                            <div class="uploaded-file-block uploaded-portfolio-block">
                                <input type="hidden" name="currentPortfolios[]" value="{{$id}}"/>
                                <img class="portfolio-img" src="{{$file['file']}}"/>
                                <img src="{{asset('img/icons/cross-remove.svg')}}" class="remove-btn-icon pointer">
                            </div>
                        @endforeach
                    </div>
                    <div class="checkbox">
                        <input class="cb" name="is_subscriber" {{$user_info['is_subscriber'] ? 'checked="checked"' : ''}} type="checkbox" id="is-subscriber-checkbox">
                        <label for="is-subscriber-checkbox">{{$translates['subscribe_new_collections']}}</label>
                    </div>
                    <div class="input-initial-save-btn input-save-general-btn"><button>{{$translates['save']}}</button></div>
                    <div class="input-save-btn input-initial-save-btn" id="input-save-portfolio-uploads"><button>{{$translates['save']}}</button></div>
                @endif
                <button id="removeUserBtn" class="submit-btn">{{$translates['remove_account']}}</button>
          </div>
        </form>
        <form id="removeUserForm" action="/remove-user" method="POST">
            @csrf
        </form>
  </section>
	
	<!-- Load CSS -->
	
        <link rel="stylesheet"  href="{{asset('css/normalize.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/fonts.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/header-lk.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/lk-11.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/lk-7.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/footer-lk.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/selectr.css')}}" />
	<!-- Load Scripts -->
    <script src="{{asset('libs/anime.min.js')}}"></script>
    <script src="{{asset('js/plugins-lk.js')}}"></script>
    <script src="{{asset('js/selectr.js')}}"></script>
    <script src="{{asset('js/server.js')}}"></script>
  <script>
    let updateUserDetailsForm = document.getElementById('updateUserDetailsForm');
    let participationUploadsBtn = document.getElementById('input-save-participation-uploads');
    let portfolioUploadsBtn = document.getElementById('input-save-portfolio-uploads');
    let isArtist = document.getElementById('is-artist').value;

    document.getElementById('removeUserBtn').addEventListener('click', e => {

        e.preventDefault();
        
        if(confirm(`{{$translates['are_you_sure']}}`))
            document.getElementById('removeUserForm').submit();
    });

    document.getElementById('avatar-upload').addEventListener('change', e => {
        updateUserDetailsForm.submit();
    });

    document.getElementById('is-subscriber-checkbox').addEventListener('change', e => {
        e.target.value = +e.target.checked;
    });

    if(+isArtist)
    {
        function getSelected(element)
        {
            let items = new Array();
            if (element != null)
                for (let option of element.selectedOptions)
                    items.push(option.value);

            return items;
        };


        let artistStylesList = new Selectr('#artist-styles', {
            multiple: true,
            placeholder: `{{$translates['styles']}}`
        });

        let artistStyles = document.querySelector('.selectr-container');
        let artistSaveBtn = document.getElementById('artist-styles-input-save');

        artistStyles.addEventListener('click', e => {
            artistSaveBtn.style.display = 'block';
        });

        artistSaveBtn.addEventListener('click', e => {
            e.preventDefault();

            let styles = getSelected(document.getElementById('artist-styles'));

            server.request('/update-artist-styles', { 'styles' : JSON.stringify(styles) })
            .then(data => {
                location.reload();
            });
        });

        let removeBtns = document.querySelectorAll('.remove-btn-icon');

        for (let index = 0; index < removeBtns.length; index++) 
        {
            removeBtns[index].addEventListener('click', e => {
                e.target.parentElement.remove();
                participationUploadsBtn.style.display = 'block';
            });
        }

        document.getElementById('participation-upload').addEventListener('change', e => {
            let files = e.target.files;
            let uploadBlock = document.getElementById('uploaded-participation-files');

            for(let i = 0; i < files.length; ++i)
            {
                let fileBlock = document.createElement('div');
                let fileName = document.createElement('span');
                let removeBtn = document.createElement('img');

                fileBlock.classList.add('uploaded-file-block');
                fileBlock.dataset.file = JSON.stringify(files[i]);
                fileName.textContent = files[i].name;
                removeBtn.src = `{{asset('img/icons/cross-remove.svg')}}`;
                removeBtn.classList.add('remove-btn-icon');
                removeBtn.classList.add('pointer');
                removeBtn.addEventListener('click', e => fileBlock.remove());

                fileBlock.appendChild(fileName);
                fileBlock.appendChild(removeBtn);
                uploadBlock.appendChild(fileBlock);
            }

            participationUploadsBtn.style.display = 'block';
        });

        document.getElementById('portfolio-upload').addEventListener('change', function(e) {

            var uploadBlock = document.getElementById('uploaded-portfolio-files');

            if (this.files) 
                [].forEach.call(this.files, readAndPreview);

            function readAndPreview(file) {

                var reader = new FileReader();

                reader.addEventListener("load", function() {

                    let fileBlock = document.createElement('div');
                    let fileImg = document.createElement('img');
                    let removeBtn = document.createElement('img');

                    fileBlock.classList.add('uploaded-file-block');
                    fileBlock.classList.add('uploaded-portfolio-block');
                    fileBlock.dataset.file = JSON.stringify(file);
                    fileImg.classList.add('portfolio-img');
                    fileImg.src = this.result;
                    removeBtn.src = `{{asset('img/icons/cross-remove.svg')}}`;
                    removeBtn.classList.add('remove-btn-icon');
                    removeBtn.classList.add('pointer');
                    removeBtn.addEventListener('click', e => fileBlock.remove());

                    fileBlock.appendChild(fileImg);
                    fileBlock.appendChild(removeBtn);
                    uploadBlock.appendChild(fileBlock);
                });
                
                reader.readAsDataURL(file);

            }

            portfolioUploadsBtn.style.display = 'block';
        });
    }

  </script>
@endsection

@include('layouts.footer_account')