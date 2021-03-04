@extends('layouts.registerationSite')

@section('title')
    تسجيل الاشتراك |زبون
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="container">
                <div class="text-right mx-5 my-1">
                    <h3 class="px-5 my-1 text-warning MontserratArabic"> ترزي.</h3>
                    <p class="p-5 MontserratArabicLight">
                        تسجيل الدخول
                    </p>
                </div>

                <form method="post" action="{{route('customer.register')}}" class="form justify-content-center px-5 mx-5 needs-validation reg-form-custom" _lpchecked="1" novalidate>
                   @csrf
                    <div class="row">
                        <div role="group" class="form-group col-md-12 col-sm-12">
                            <input name="name" id="name" value="{{old('name')}}"  type="text" class="form-control focus" >
                            <label  class="d-block form-control-placeholder MontserratArabicLight" >الاسم كاملا </label>
                            @error('name')
                            <span id="name" class="text-danger MontserratArabicLight float-right">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div role="group" class="form-group col-md-12  col-sm-12">
                            <input name="email" id="email" value="{{old('email')}}" type="text" class="form-control focus" >
                            <label  class="d-block form-control-placeholder MontserratArabicLight" >الايميل او رقم الهاتف </label>
                            @error('email')
                            <span id="email" class="text-danger MontserratArabicLight float-right">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div role="group" class="form-group  col-md-12 col-sm-12">
                            <input name="password" id="password" value="{{old('password')}}" type="password" class="form-control focus" >
                            <label  class="d-block form-control-placeholder MontserratArabicLight" >كلمة السر</label>
                            <span class="after-input"><i toggle="#password" class="fa fa-eye toggle-password" aria-hidden="true"></i>
                        </span>
                            <span><small class="float-right MontserratArabicLight">كلمة السر يجب ان تكون ما بين 4 الى 6 احرف</small></span>
                            <br>
                            @error('password')
                            <span id="password" class="text-danger MontserratArabicLight float-right">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div role="group" class="form-group col-md-12  col-sm-12">
                            <input name="password_confirmation" id="password_confirmation" type="password" class="form-control focus" >
                            <label  class="d-block form-control-placeholder MontserratArabicLight" >تاكيد كلمة السر</label>
                            <span class="after-input"><i toggle="#password_confirmation" class="fa fa-eye toggle-password" aria-hidden="true"></i>
                        </span>
                            @error('password')
                            <span id="password" class="text-danger MontserratArabicLight float-right">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div role="group" class="form-group col-md-12  col-sm-12 d-flex">
                            <input type="checkbox" name="terms_conditions" class="form-check-input float-right" id="exampleCheck1">
                            <label class="form-check-label mr-3 MontserratArabicLight" for="exampleCheck1">
                                <small>
                                    لقد قبلت
                                    <span>
                            <a href="" class="text-warning">
                              الشروط والأحكام
                            </a>
                          </span>
                                </small>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <button class="btn btn-yellow w-100 m-3">تسجيل </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 register-img">
            <div class="position text-right">
                <h3 class="p-4 my-2 text-warning">منصة ترزي</h3>

                <p class="px-2 text-white">
                    هي منصة تتيح لك اختيار ذوق اللبس الخاص بك بنوع القماش الذي يناسبك                    </p>
                <button class="m-2 btn btn-yellow">تسجيل الدخول ك عميل  </button>
            </div>
        </div>
        <div class="container ">
            <div class="row mx-5 px-4 justify-content-center">
                <p class="MontserratArabicLight" style="text-align: center;">
                    أو قم بالتسجيل من خلال
                </p>
            </div>
            <hr class="mx-5 px-5">
            <div class="row mx-5 px-4 justify-content-center">
                <a><i class="icon-custom fa fa-apple px-3"></i></a>
                <a href="{{route('service','google')}}"><i class="icon-custom fa fa-google px-3"></i></a>
                <a href="{{route('service','facebook')}}"><i class="icon-custom fa fa-facebook-f px-3"></i></a>
            </div>
    </div>
@endsection
