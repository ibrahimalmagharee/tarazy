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
                                    <a href="{{route('index.fabrics')}}">الأقمشة  </a>

                                </li>
                                <li class="breadcrumb-item active"> تعديل -
                                    {{$fabric->name}}</li>
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
                                            {{$fabric->name}} </strong></h4>
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
                                                  action="{{route('update.fabric',$fabric->id)}}"
                                                  id="fabricForm" enctype="multipart/form-data">
                                                @csrf
                                                <h4 class="form-section"><i
                                                        class="ft-home"></i> تعديل - {{$fabric->name}}
                                                </h4>
                                                <input type="hidden" name="id" value="{{$fabric->id}}">
                                                <div class="form-group">
                                                    <div class="text-center">
                                                        <img src="{{$fabric->getPhoto($fabric->image->photo)}}" alt="photo"
                                                             class="height-150">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label> اختر الصورة</label>
                                                    <label id="projectinput7" class="file center-block">
                                                        <input type="file" id="file" name="photo">
                                                        <span class="file-custom"></span>
                                                    </label>
                                                    @error('photo')
                                                    <span id="photo_error" class="text-danger">{{$message}} </span>
                                                    @enderror
                                                </div>
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput2">اختر التاجر</label>
                                                                <select name="vendor_id" id="vendor_id" class="select2 form-control width-360">
                                                                    <optgroup label="الرجاء اختر التاجر">
                                                                        @isset($data['vendors'])
                                                                            @foreach($data['vendors'] as $vendor)
                                                                                <option value="{{$vendor->id}}" @if($fabric->product->vendor_id == $vendor->id) selected @endif>{{$vendor->company_name}}</option>
                                                                            @endforeach
                                                                        @endisset
                                                                    </optgroup>
                                                                </select>

                                                                @error('vendor_id')
                                                                <span id="vendor_id_error" class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1">الاسم</label>
                                                                <input type="text" id="name" class="form-control" placeholder=""
                                                                       name="name" value="{{$fabric->name}}">

                                                                @error('name')
                                                                <span id="name_error" class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput2">اللون</label>
                                                                <select name="color_id" id="color_id" class="form-control">
                                                                    <optgroup label="الرجاء اختر اللزن">
                                                                        @isset($data['colors'])
                                                                            @foreach($data['colors'] as $color)
                                                                                <option value="{{$color->id}}" @if($fabric->color_id == $color->id) selected @endif>{{$color->color}}</option>
                                                                            @endforeach
                                                                        @endisset
                                                                    </optgroup>
                                                                </select>
                                                                @error('color_id')
                                                                <span id="color_id_error" class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput2">اختر الفئة</label>
                                                                <select name="category_id" id="category_id" class="form-control">
                                                                    <optgroup label="الرجاء اختر الفئة">
                                                                        @isset($data['categories'] )
                                                                            @foreach($data['categories'] as $category)

                                                                                <option value="{{$category->id}}" @if($fabric->product->category_id == $category->id) selected @endif>{{$category->name}}</option>

                                                                            @endforeach
                                                                        @endisset
                                                                    </optgroup>
                                                                </select>
                                                                @error('category_id')
                                                                <span id="category_id_error" class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> وصف المنتج</label>
                                                                <textarea name="description" id="short-description" cols="3" rows="6"
                                                                          class="form-control" placeholder="سيتطلع المشتري على تفاصيل المنتج لاخاصة">{{$fabric->description}}</textarea>
                                                            </div>
                                                            @error('description')
                                                            <span id="description_error" class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1">السعر</label>
                                                                <input type="number" id="price" class="form-control" placeholder="300"
                                                                       name="price" value="{{$fabric->product->price}}">

                                                                @error('price')
                                                                <span id="price_error" class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput2"> العروض</label>
                                                                <select name="offer_id" id="offer_id" class="form-control">
                                                                    <optgroup label="الرجاء اختر العرض">
                                                                        @isset($data['offers'] )
                                                                            @foreach($data['offers'] as $offer)

                                                                                <option value="{{$offer->id}}" @if($fabric->product->offer_id == $offer->id) selected @endif>{{$offer->name}}</option>

                                                                            @endforeach
                                                                        @endisset
                                                                    </optgroup>
                                                                </select>

                                                                @error('offer_id')
                                                                <span id="offer_id_error" class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-actions">
                                                    <a href="{{route('index.fabrics')}}" class="btn btn-warning mr-1" data-dismiss="modal"><i
                                                            class="la la-undo"></i> تراجع
                                                    </a>
                                                    <button class="btn btn-primary" id="updateFabric"><i class="la la-edit"></i> تحديث</button>
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


