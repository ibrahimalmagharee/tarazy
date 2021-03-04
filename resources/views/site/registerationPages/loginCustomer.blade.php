@extends('layouts.registerationSite')

@section('title')
    تسجيل الدخول |زبون
    @endsection
@section('content')
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="container">
                <div class="text-right mx-5 my-1">
                    <h3 class="px-5 my-1 text-warning MontserratArabic"> ترزي.</h3>
                    <p class="px-5 mt-5 MontserratArabicLight">
                        أهلا بك مرة أخرى!
                    </p>
                </div>

                <form method="post" action="{{route('check.customer.login')}}" class="form justify-content-center px-5 mx-5 reg-form-custom" _lpchecked="1">
                    @csrf
                    <div class="row">
                        <div role="group" class="form-group  col-md-12 col-sm-12">
                            <input name="email" id="email" value="{{old('email')}}" type="text" class="form-control focus">
                            <label  class="d-block form-control-placeholder MontserratArabicLight">الايميل</label>
                            @error('email')
                            <span id="email" class="text-danger MontserratArabicLight float-right">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div role="group" class="form-group  col-md-12 col-sm-12">
                            <input name="password" id="password" type="password" value="{{old('password')}}" class="form-control focus" required="required">
                            <label  class="d-block form-control-placeholder MontserratArabicLight" required="required">كلمة السر</label>
                            <span class="log-after-input"><i toggle="#password" class="fa fa-eye toggle-password" aria-hidden="true"></i>
                        </span>
                            @error('email')
                            <span id="email" class="text-danger MontserratArabicLight float-right">{{$message}}</span>
                            @enderror
                            <a href="">
                                <small class="float-left text-warning MontserratArabicLight">نسيت كلمة السر ؟</small>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <button class="btn btn-yellow w-100 m-3 MontserratArabicLight">تسجيل الدخول </button>
                    </div>
                </form>
                <div class="container ">
                    <div class="row mx-5 px-4 justify-content-center">
                        <p class="MontserratArabicLight" style="text-align: center;">
                            أو قم بالتسجيل من خلال
                        </p>
                    </div>
                    <hr class="mx-5 px-5">
                    <div class="row mx-5 px-4 justify-content-center">
                        <i class="icon-custom fa fa-apple px-3"></i>
                        <a href="{{route('service','google')}}"><i class="icon-custom fa fa-google px-3"></i></a>
                        <a href="{{route('service','facebook')}}"><i class="icon-custom fa fa-facebook-f px-3"></i></a>
                    </div>

                    <div class="row mx-5 p-4 justify-content-center">
                        لديك حساب بالفعل ؟ <span> <a href="" class="text-warning MontserratArabicLight"> سجل الدخول الان</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 login-img">
            <div class="position text-right">
                <h3 class="p-4 my-2 text-warning MontserratArabicLight">منصة ترزي</h3>

                <p class="px-2 text-white MontserratArabicLight">
                    هي منصة تتيح لك اختيار ذوق اللبس الخاص بك بنوع القماش الذي يناسبك                    </p>
                <button class="m-2 btn btn-yellow login-btn">سجل ك تاجر الآن  </button>
            </div>
        </div>
    </div>
@endsection
