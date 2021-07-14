@include('layouts.header_main')

@section('content')

    <x-guest-layout>
        <div class="pt-4 bg-gray-100">
            <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
                <div>
                    <x-jet-authentication-card-logo />
                </div>

                <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    <div class="user-form__link-back">
                        <a href="{{url('/')}}"><i class="icon-arrow-slide-left"></i>{{$translates['back']}}</a>
                    </div>
                    {!! $terms !!}
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