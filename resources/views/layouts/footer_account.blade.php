@extends('layouts.app')

@section('footer')

    <footer class="footer">

        <div class="footer__inner">
            <div class="footer__navigation--list">
                <div class="footer__navigation--wrapper">
                    <div class="footer__navigation--item">
                        <a href="/terms"><p>{{$translates['banking_guarantee']}}</p></a>
                    </div>
                    <div class="footer__navigation--item">
                        <a href="/terms"><p>{{$translates['legal_information']}}</p></a>
                    </div>
                    <div class="footer__navigation--item">
                        <a href="/terms"><p>{{$translates['terms']}}</p></a>
                    </div>
                </div>

                <div class="footer__navigation--item footer-logo">
                    <p>{{$translates['site_developed']}}</p><a href="#"><img src="{{asset('img/company.svg')}}" alt=""></a>
                </div>
            </div>

        </div>

    </footer>

@endsection
