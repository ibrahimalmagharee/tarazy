@extends('layouts.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"></h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{route('admin.dashboard')}}">الرئيسية  </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{route('index.vendors')}}">التجار  </a>

                                </li>
                                <li class="breadcrumb-item active"> تعديل -
                                    {{$vendor->company_name}}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title text-center">
                                        <strong> تعديل -
                                            {{$vendor->company_name}} </strong></h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>


                                <!--  Begin Form Edit -->

                                    <div class="card-content collapse show">
                                        <div class="card-body">
                                            <form class="form" method="post"
                                                  action="{{route('update.vendor',$vendor->id)}}"
                                                  id="vendorForm" enctype="multipart/form-data">
                                                @csrf
                                                <h4 class="form-section"><i
                                                        class="ft-home"></i> تعديل - {{$vendor->company_name}}
                                                </h4>
                                                <input type="hidden" name="id" value="{{$vendor->id}}">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> اسم الشركة </label>
                                                                <input type="text" id="company_name" class="form-control" placeholder="مثال:شركة المدينة المنورة"
                                                                       name="company_name" value="{{$vendor->company_name}}">

                                                                @error('company_name')
                                                                <span id="company_name_error" class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> موقع الشركة </label>
                                                                <input type="text" id="location" class="form-control" placeholder="مثال:الرياض"
                                                                       name="location" value="{{$vendor->location}}">

                                                                @error('location')
                                                                <span id="location_error" class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> رقم السجل النجاري </label>
                                                                <input type="number" id="commercial_registration_No" class="form-control" placeholder="مثال:5658"
                                                                       name="commercial_registration_No" value="{{$vendor->commercial_registration_No}}">

                                                                @error('commercial_registration_No')
                                                                <span id="commercial_registration_No_error" class="text-danger">{{$message}}</span>
                                                                @enderror

                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> رقم الجوال </label>
                                                                <input type="number" id="mobile_No" class="form-control" placeholder="مثال:0599664473"
                                                                       name="mobile_No" value="{{$vendor->mobile_No}}">

                                                                @error('mobile_No')
                                                                <span id="mobile_No_error" class="text-danger">{{$message}}</span>
                                                                @enderror

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> الهوية الوطنية </label>
                                                                <input type="number" id="national_Id" class="form-control" placeholder="مثال:505990014"
                                                                       name="national_Id" value="{{$vendor->national_Id}}">

                                                                @error('national_Id')
                                                                <span id="national_Id_error" class="text-danger">{{$message}}</span>
                                                                @enderror

                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> الايميل </label>
                                                                <input type="email" id="email" class="form-control" placeholder="مثال:almadina@gmail.com"
                                                                       name="email" value="{{$vendor->email}}">

                                                                @error('email')
                                                                <span id="email_error" class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="projectinput2"> نوع النشاط </label>
                                                                <select name="type_activity" id="type_activity" class="select form-control">
                                                                    <optgroup label="حدد نوع النشاط">
                                                                        <option value="تصاميم" @if($vendor->type_activity == 'تصاميم') selected @endif>تصاميم</option>
                                                                        <option value="أفمشة" @if($vendor->type_activity == 'أفمشة') selected @endif>أفمشة</option>
                                                                        <option value="الاثنين معا" @if($vendor->type_activity == 'الاثنين معا') selected @endif>الاثنين معا</option>
                                                                    </optgroup>
                                                                </select>
                                                                @error('type_activity')
                                                                <span id="type_activity_error" class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1">كلمة السر </label>
                                                                <input type="text" id="password" class="form-control" placeholder="مثال:******"
                                                                       name="password" value="{{$vendor->password}}">

                                                                @error('password')
                                                                <span id="password_error" class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1">كلمة السر </label>
                                                                <input type="text" id="password_confirmation" class="form-control" placeholder="مثال:******"
                                                                       name="password_confirmation" value="{{$vendor->password}}">

                                                                @error('password_confirmation')
                                                                <span id="password_confirmation_error" class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-actions">
                                                    <a href="{{route('index.vendors')}}" class="btn btn-warning mr-1" data-dismiss="modal"><i
                                                            class="la la-undo"></i> تراجع
                                                    </a>
                                                    <button class="btn btn-primary" id="updateVendor"><i class="la la-edit"></i> تحديث</button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>
@endsection


