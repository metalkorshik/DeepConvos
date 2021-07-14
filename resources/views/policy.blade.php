@include('layouts.header_main')

@section('content')

    <x-guest-layout>
        <div class="pt-4 bg-gray-100">
            <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
                <div>
                    <x-jet-authentication-card-logo />
                </div>

                <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg col-block" style="margin-top: 50px">
                    <div class="user-form__link-back">
                        <a href="{{url('/')}}"><i class="icon-arrow-slide-left"></i>{{$translates['back']}}</a>
                    </div>
                    <a target="_blank" href="/storage/documents/Политика_в_отношении_обработки_персональных_данных_ООО.pdf">{{$translates['personal_data_policy']}}</a>
                    <a target="_blank" href="/storage/documents/Публичная оферта Deep Convos.pdf">{{$translates['public_offer_convos']}}</a>
                    <a target="_blank" href="/storage/documents/Согласие_на_направление_рекламных_сообщений.pdf">{{$translates['consent_adv_messages']}}</a>
                    <a target="_blank" href="/storage/documents/Согласие_на_обработку_персональных_данных.pdf">{{$translates['concent_processing_data']}}</a>
                </div>
            </div>
        </div>
    </x-guest-layout>

    <link rel="stylesheet"  href="{{asset('css/normalize.css')}}" />
    <link rel="stylesheet"  href="{{asset('css/swiper.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/fonts.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/header2.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/main5.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/footer.css')}}" />

@endsection

@include('layouts.footer_main')