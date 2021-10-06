@extends('layouts.frontend.app')

@section('title','Contact')

@push('css')
    <link href="{{ asset('assets/frontend/css/category/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/category/responsive.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        /*---------------------
        Contact
        -----------------------*/
        .contact {
            padding-top: 80px;
            padding-bottom: 50px;
        }

        .contact__widget {
            margin-bottom: 30px;
        }

        .contact__widget span {
            font-size: 36px;
            color: #7fad39;
        }

        .contact__widget h4 {
            color: #1c1c1c;
            font-weight: 700;
            margin-bottom: 6px;
            margin-top: 18px;
        }

        .contact__widget p {
            color: #666666;
            margin-bottom: 0;
        }

        /*---------------------
        Map
        -----------------------*/

        .map {
            height: 500px;
            position: relative;
        }

        .map iframe {
            width: 100%;
        }

        .map .map-inside {
            position: absolute;
            left: 50%;
            top: 160px;
            -webkit-transform: translateX(-175px);
            -ms-transform: translateX(-175px);
            transform: translateX(-175px);
        }

        .map .map-inside i {
            font-size: 48px;
            color: #7fad39;
            position: absolute;
            bottom: -75px;
            left: 50%;
            -webkit-transform: translateX(-18px);
            -ms-transform: translateX(-18px);
            transform: translateX(-18px);
        }

        .map .map-inside .inside-widget {
            width: 350px;
            background: #ffffff;
            text-align: center;
            padding: 23px 0;
            position: relative;
            z-index: 1;
            -webkit-box-shadow: 0 0 20px 5px rgba(12, 7, 26, 0.15);
            box-shadow: 0 0 20px 5px rgba(12, 7, 26, 0.15);
        }

        .map .map-inside .inside-widget:after {
            position: absolute;
            left: 50%;
            bottom: -30px;
            -webkit-transform: translateX(-6px);
            -ms-transform: translateX(-6px);
            transform: translateX(-6px);
            border: 12px solid transparent;
            border-top: 30px solid #ffffff;
            content: "";
            z-index: -1;
        }

        .map .map-inside .inside-widget h4 {
            font-size: 22px;
            font-weight: 700;
            color: #1c1c1c;
            margin-bottom: 4px;
        }

        .map .map-inside .inside-widget ul li {
            list-style: none;
            font-size: 16px;
            color: #666666;
            line-height: 26px;
        }

        /*---------------------
        Contact Form
        -----------------------*/

        .contact__form__title {
            margin-bottom: 50px;
            text-align: center;
        }

        .contact__form__title h2 {
            color: #1c1c1c;
            font-weight: 700;
        }

        .contact-form {
            padding-top: 80px;
            padding-bottom: 80px;
        }

        .contact-form form input {
            width: 100%;
            height: 50px;
            font-size: 16px;
            color: #6f6f6f;
            padding-left: 20px;
            margin-bottom: 30px;
            border: 1px solid #ebebeb;
            border-radius: 4px;
        }

        .contact-form form input::placeholder {
            color: #6f6f6f;
        }

        .contact-form form textarea {
            width: 100%;
            height: 150px;
            font-size: 16px;
            color: #6f6f6f;
            padding-left: 20px;
            margin-bottom: 24px;
            border: 1px solid #ebebeb;
            border-radius: 4px;
            padding-top: 12px;
            resize: none;
        }
        .spad {
            padding-top: 100px;
                padding-bottom: 100px;

            .contact-form form textarea::placeholder {
                color: #6f6f6f;
            }

            .contact-form form button {
                font-size: 18px;
                letter-spacing: 2px;
            }
            .hot-site-btn {
                font-size: 14px;
                color: #ffffff;
                font-weight: 800;
                text-transform: uppercase;
                display: inline-block;
                padding: 13px 30px 12px;
                background: #7fad39;
                border: none;
            }
    </style>
@endpush

@section('content')
<!-- Contact Section Begin -->
<div class="slider display-table center-text">
    <h1 class="title display-table-cell"><b>Contact Us</b></h1>
</div><!-- slider -->

<section class="contact spad">
    <div class="container">
        <div class="row"> 
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <i class="material-icons">call</i>
                    <h4>Hotline</h4>
                    <p>+084-0922-353-113</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <i class="material-icons">home</i>
                    <h4>Address</h4>
                    <p>Hiệp Hòa, Vũ Thư, Thái Bình</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <i class="material-icons">schedule</i>
                    <h4>Open time</h4>
                    <p>8:00 am to 17:00 pm</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <i class="material-icons">email</i>
                    <h4>Email</h4>
                    <p>phuongdauduaim@gmail.com</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->

<!-- Map Begin -->
<div class="map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29898.003421003308!2d106.23062564350609!3d20.49595781786777!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135e6066a700eb1%3A0x7778ae055b801388!2zSGnhu4dwIEjDsmEsIFbFqSBUaMawLCBUaMOhaSBCw6xuaCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1633272598021!5m2!1svi!2s" 
    width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    <div class="map-inside">
        <i class="icon_pin"></i>
        <div class="inside-widget">
            <h4>Việt Nam</h4>
            <ul>
                <li>Phone: +084922353113</li>
                <li>Add: Hiệp Hòa, Vũ Thư, Thái Bình</li>
            </ul>
        </div>
    </div>
</div>
<!-- Map End -->

<!-- Contact Form Begin -->
<div class="contact-form spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact__form__title">
                    <h2>Leave Message</h2>
                </div>
            </div>
        </div>
        <form action="#">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <input type="text" placeholder="Your name">
                </div>
                <div class="col-lg-6 col-md-6">
                    <input type="text" placeholder="Your Email">
                </div>
                <div class="col-lg-12 text-center">
                    <textarea placeholder="Your message"></textarea>
                    <button type="submit" class="hot-site-btn">SEND MESSAGE</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')

@endpush