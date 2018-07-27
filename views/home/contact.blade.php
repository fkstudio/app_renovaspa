@extends('layout/baseLayout')

@inject('recaptcha', 'App\Classes\ReCaptchaLib');

@section('title', 'Contact')

@section("head")
<script src='https://www.google.com/recaptcha/api.js'></script>
@endsection

@section('content')
    <div class="container-fluid container-fluid-full">
        <div class="row">
            <div class="col-lg-6 col-md-6 hidden-sm hidden-xs"  style="height:400px;background: url({{ URL::to('/images') }}/about-bg.jpg);background-size: cover;">

            </div>
            <div class="col-lg-6 col-md-6" style="height: 400px;background: #5fc7ae;text-align: center;">
                <img src="{{ URL::to('/') }}/images/renova_white.png" style="width: 250px;margin: 30px auto;">
                <div class="clearfix"></div>

                <p style="color: white;">
                   <span style="font-size:30px;" class="glyphicon glyphicon-envelope"></span>
                   <br/>
                   <a style="color:white;" href="mailto:info@renovaspa.com">info@renovaspa.com</a> </br>
                   Plaza Progreso - Local 21</br>
                   Bavaro - Higuey, Dominican Republic</p>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <br/>
    <div class="container-fluid">
        <div class="col-md-12">
            @include('shared._messages')
        </div>
        <div class="clearfix"></div>
        <div class="col-lg-5 col-sm-12 col-xs-12">
            <div class="col-lg-12 text-center">
            <SMALL>Please accept our terms & conditions to submit your message!</SMALL><br><br>
                <h4>THANK YOU FOR YOUR INTEREST IN RENOVA SPA!</h4>
                <p>Our Team at RenovaSPA aims to deliver a positive experience and friendly atmosphere to all of their guests. Therefore, please do not hesitate to contact us for any questions, wishes and comments, at any time. In order to reply to you effectively and in a timely manner, please complete the form below, and agree with our terms & conditions.</p>
            </div>
            <div class="clearfix"></div>
            <br/>
            <form method="POST" action="{{ URL::to('/') }}/send/contact/form">
                <div class="col-lg-6">
                    <div class="form-group">
                        <input type="" name="name" class="form-control input-border" placeholder="Your name">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <input type="email" name="email" class="form-control input-border" placeholder="Your Email-Address">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <input type="" name="hotel" class="form-control input-border" placeholder="Your hotel">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <textarea rows="6" name="message" class="form-control input-border" placeholder="Your message"></textarea>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <input type="checkbox" name="terms" /> I have read and accepted the Privacy Policy.
                    </div>
                </div>
                <div class="clearfix"></div>
                <br/>
                <div class="col-lg-12">
                    <div class="form-group">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary btn-block" placeholder="Your hotel">SUBMIT</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="clearfix hidden-md hidden-lg"></div>
        <br class="hidden-md hidden-lg" />
        <div class="col-lg-5 col-sm-12 col-xs-12 col-lg-offset-1">
            <div class="col-lg-12 text-center">
                <h4>JOIN OUR TEAM</h4>
                <br/>
                <p>We love to meet people and talk about possibilities</p>
                <br/>
                <SMALL>Fill out out the information below and upload your resume</SMALL>
            </div>
            <div class="clearfix"></div>
            <br/>
            <br/>
            <form method="POST" action="{{ URL::to('/') }}/send/join/form" enctype="multipart/form-data">
                <div class="col-lg-6">
                    <div class="form-group">
                        <input type="" name="position" class="form-control input-border" placeholder="Position applying for">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <input type="" name="country" class="form-control input-border" placeholder="City/Country where applying">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <input type="" name="name" class="form-control input-border" placeholder="Name(First, Middle, Inicial, Last)">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <input type="Email" name="email" class="form-control input-border" placeholder="Email">
                    </div>
                </div>
                <div class="clearfix"></div>
                <br/>
                <br/>
                <div class="col-lg-12">
                    <div class="form-group">
                        <p>Upload your resume (.TXT or .DOC file only)</p>
                        <input type="file" name="resume" />
                    </div>
                </div>
                <div class="clearfix"></div>
                <br/>
                <div class="col-lg-12">
                    <div class="form-group">
                        {{ csrf_field() }}
                        <button type="submit" style="margin-top: 13px" class="btn btn-primary btn-block" placeholder="Your hotel">APPLY</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
