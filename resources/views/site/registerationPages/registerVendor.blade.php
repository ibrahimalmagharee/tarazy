@extends('layouts.registerationSite')

@section('title')
    تسجيل الاشتراك تاجر
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="container">
                <div class="text-right mx-5 my-1">
                    <h3 class="px-5 my-1 text-warning MontserratArabic"> ترزي.</h3>
                    <p class="px-5 pt-3 MontserratArabicLight">
                        تسجيل الدخول
                    </p>
                </div>
                <form method="post" action="{{route('vendor.register')}}" class="form justify-content-center px-5 mx-5 needs-validation reg-form-custom" _lpchecked="1">
                    @csrf
                    <div class="row">
                        <div role="group" class="form-group  col-md-12 col-sm-12">
                            <label  class="d-block form-control-placeholder MontserratArabicLight" >اسم الشركة</label>
                            <input  type="text" class="form-control focus" name="company_name" value="{{old('company_name')}}">
                            @error('company_name')
                            <span id="company_name" class="text-danger MontserratArabicLight float-right">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div role="group" class="form-group col-md-12 col-sm-12">
                            <label  class="d-block form-control-placeholder MontserratArabicLight" >موقع الشركة</label>
                            <input  type="text" class="form-control focus" name="location" value="{{old('location')}}">
                            <span class="after-input"><i class="fa fa-map-marker" ></i>
                        </span>
                            @error('location')
                            <span id="location" class="text-danger MontserratArabicLight float-right">{{$message}}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="row">
                        <div role="group" class="form-group  col-md col-sm-12 ">
                            <input  type="number" class="form-control focus" name="commercial_registration_No" value="{{old('commercial_registration_No')}}">
                            <label  class="d-block form-control-placeholder MontserratArabicLight" >رقم السجل التجاري</label>
                            @error('commercial_registration_No')
                            <span id="commercial_registration_No" class="text-danger MontserratArabicLight">{{$message}}</span>
                            @enderror
                        </div>
                        <div role="group " class="form-group  col-md col-sm-12 ">
                            <input  type="number" name="mobile_No" value="{{old('mobile_No')}}" class="form-control focus" >
                            <label  class="d-block form-control-placeholder" >رقم الجوال</label>
                            @error('mobile_No')
                            <span id="mobile_No" class="text-danger MontserratArabicLight float-right">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div role="group" class="form-group  col-md-12 col-sm-12">
                            <input  type="number" class="form-control focus" name="national_Id" value="{{old('national_Id')}}">
                            <label class="d-block form-control-placeholder MontserratArabicLight" >الهوية الوطنية</label>
                            @error('national_Id')
                            <span id="national_Id" class="text-danger MontserratArabicLight float-right">{{$message}}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="row">
                        <div role="group" class="form-group col-md-12 col-sm-12">
                            <input  type="email" name="email" value="{{old('email')}}" class="form-control focus" >
                            <label  class="d-block form-control-placeholder MontserratArabicLight" >الايميل</label>
                            @error('email')
                            <span id="email" class="text-danger MontserratArabicLight float-right">{{$message}}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="row">
                        <div role="group" class="form-group  col-md-12 col-sm-12">
                            <select name="type_activity" id="type_activity" class="form-control focus MontserratArabicLight">
                                <option value="" >حدد نوع النشاط</option>
                                <option value="تفصيل" >تفصيل</option>
                                <option value="تصميم" >تصميم</option>
                                <option value="الاثنين معا" >الاثنين معا</option>
                            </select>
                            @error('type_activity')
                            <span id="type_activity" class="text-danger MontserratArabicLight float-right">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div role="group" class="form-group col-md-12 col-sm-12">
                            <input  type="password" id="password" class="form-control focus" name="password" value="{{old('password')}}">
                            <label  class="d-block form-control-placeholder MontserratArabicLight" >كلمة السر</label>
                            <span class="after-input"><i toggle="#password" class="fa fa-eye toggle-password" ></i>
                        </span>
                            <span><small class="float-right MontserratArabicLight">كلمة السر يجب ان تكون ما بين 4 الى 6 احرف</small></span>
                            <br>
                            @error('password')
                            <span id="password" class="text-danger MontserratArabicLight float-right">{{$message}}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="row">
                        <div role="group" class="form-group  col-md-12 col-sm-12">
                            <input  type="password" name="password_confirmation" id="password_confirmation" value="{{old('password_confirmation')}}" class="form-control focus" >
                            <label  class="d-block form-control-placeholder MontserratArabicLight" >تاكيد كلمة السر</label>
                            <span class="after-input"  ><i toggle="#password_confirmation" class="fa fa-eye toggle-password"></i>
                        </span>
                            @error('password')
                            <span id="password" class="text-danger MontserratArabicLight float-right">{{$message}}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="row">
                        <button class="btn btn-yellow w-100 m-2">تسجيل </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 register-img">
            <div class="position text-right">
                <h3 class="p-4 my-2 text-warning MontserratArabic">منصة ترزي</h3>

                <p class="px-2 text-white MontserratArabicLight">
                    هي منصة تتيح لك اختيار ذوق اللبس الخاص بك بنوع القماش الذي يناسبك                    </p>
                <button class="m-2 btn btn-yellow">تسجيل الدخول ك عميل  </button>
            </div>
        </div>
    </div>
@endsection
