@extends('layouts.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> التصاميم </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية </a></li>
                                <li class="breadcrumb-item active"> التصاميم</li>
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
                                    <a class="btn btn-outline-success float-left" href="javascript:void(0)"
                                       id="addNewDesign"><i class="la la-plus"></i>  اضافة تصميم جديد</a>
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

                                <div class="card-content collapse show" id="viewDesigns">
                                    <div class="card-body card-dashboard table-responsive">
                                        <table class="table design-table">
                                            <thead>
                                            <tr>
                                                <th>التاجر</th>
                                                <th>الاسم</th>
                                                <th>النوع</th>
                                                <th>القسم</th>
                                                <th>الصورة</th>
                                                <th>السعر</th>
                                                <th>العرض</th>
                                                <th>الاجراءات</th>

                                            </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                        <div class="justify-content-center d-flex"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <!-- Begin Form Add Main Category -->

    <div class="modal fade modal-open" id="design-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content width-800">
                <div class="modal-header">
                    <h4 class="modal-title form-section" id="modalheader">
                        <i class="ft-home"></i> اضافة تصميم
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <form class="form" id="designForm" enctype="multipart/form-data">
                                @csrf

                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput2">اختر التاجر</label>
                                                <select name="vendor_id" id="vendor_id" class="select2 form-control width-350">
                                                    <optgroup label="الرجاء اختر التاجر">
                                                        @isset($data['vendors'])
                                                            @foreach($data['vendors'] as $vendor)
                                                                <option value="{{$vendor->id}}">{{$vendor->company_name}}</option>
                                                                @endforeach
                                                            @endisset
                                                    </optgroup>
                                                </select>
                                                <span id="vendor_id_error" class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">الاسم</label>
                                                <input type="text" id="name" class="form-control" placeholder=""
                                                       name="name" value="{{old('name')}}">
                                                <span id="name_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput2">النوع</label>
                                                <select name="type_id" id="type_id" class="form-control">
                                                    <optgroup label="الرجاء اختر نوع الملابس">
                                                        @isset($data['types'])
                                                            @foreach($data['types'] as $type)
                                                                <option value="{{$type->id}}">{{$type->name}}</option>
                                                            @endforeach
                                                        @endisset
                                                    </optgroup>
                                                </select>
                                                <span id="type_id_error" class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput2">اختر القسم</label>
                                                <select name="category_id" id="category_id" class="form-control">
                                                    <optgroup label="الرجاء اختر القسم">
                                                        @isset($data['categories'] )
                                                            @foreach($data['categories'] as $mainCategory)

                                                                <option value="{{$mainCategory->id}}">{{$mainCategory->name}}</option>

                                                                @foreach ($mainCategory->childrenCategories as $childCategory)
                                                                    @include('admin.categories.child_category', ['child_category' => $childCategory])
                                                                @endforeach
                                                            @endforeach
                                                        @endisset
                                                    </optgroup>
                                                </select>
                                                <span id="category_id_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="projectinput1"> وصف المنتج</label>
                                                <textarea name="description" id="short-description" cols="3" rows="6"
                                                          class="form-control" placeholder="سيتطلع المشتري على تفاصيل المنتج لاخاصة"></textarea>
                                            </div>
                                            <span id="description_error" class="text-danger"></span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <label> اضف ضورة</label>
                                            <label id="projectinput7" class="file center-block">
                                                <input type="file" id="photo" name="photo">
                                                <span class="file-custom"></span>
                                            </label>
                                            <span id="photo_error" class="text-danger"> </span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">السعر</label>
                                                <input type="number" id="price" class="form-control" placeholder="300"
                                                       name="price" value="{{old('price')}}">
                                                <span id="price_error" class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput2"> العروض</label>
                                                <select name="offer_id" id="offer_id" class="form-control">
                                                    <optgroup label="الرجاء اختر العرض">
                                                        @isset($data['offers'])
                                                            @foreach($data['offers'] as $offer)
                                                                <option value="{{$offer->id}}">{{$offer->name}}</option>
                                                            @endforeach
                                                        @endisset
                                                    </optgroup>
                                                </select>
                                                <span id="offer_id_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <input type="hidden" name="action" id="action" value="Add">
                                    <button type="button" class="btn btn-warning mr-1" data-dismiss="modal"><i
                                            class="la la-undo"></i> تراجع
                                    </button>
                                    <button class="btn btn-primary" id="addDesign"><i class="la la-save"></i> حفظ</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End Form Add Main Category -->



    <!-- // Basic form layout section end -->



    {{-- Confirmation Modal --}}
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">تأكيد عملية الحذف</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="delete_modal_form">
                    @csrf
                    {{method_field('delete')}}

                    <div class="modal-body">
                        <input type="hidden" id="delete_language">
                        <h5>هل أنت متأكد من حذف هذا التصميم !!</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel">الغاء</button>
                        <button type="submit" class="btn btn-danger" id="delete">حذف</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Confirmation Modal --}}


@endsection

@section('script')
    <script type="text/javascript">

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //Show Table
            var designTable = $('.design-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route("index.designs")}}",
                columns: [
                    {data: 'vendor_id', name: 'vendor_id'},
                    {data: 'name', name: 'name'},
                    {data: 'type_id', name: 'type_id'},
                    {data: 'category_id', name: 'category_id'},
                    {data: 'photo', name: 'photo'},
                    {data: 'price', name: 'price'},
                    {data: 'offer_id', name: 'offer_id'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });


            //Show Form
            $('#addNewDesign').click(function () {
                $('#designForm').trigger('reset');
                $('#design-modal').modal('show');

            });


            //Add Or Update
            $(document).on('click', '#addDesign', function (e) {
                e.preventDefault();
                var formData = new FormData($('#designForm')[0]);
                $('#vendor_id_error').text('');
                $('#name_error').text('');
                $('#type_id_error').text('');
                $('#category_id_error').text('');
                $('#description_error').text('');
                $('#photo_error').text('');
                $('#price_error').text('');
                $('#offer_id_error').text('');
                $.ajax({
                    type: 'post',
                    url: "{{ route('save.design') }}",
                    enctype: 'multipart/form-data',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: 'json',

                    success: function (data) {
                        if (data.status == true) {
                            toastr.success(data.msg);
                            $('#designForm').trigger('reset');
                            $('#design-modal').modal('hide');
                            designTable.draw();
                        } else {
                            toastr.error(data.msg);
                            $('#designForm').trigger('reset');
                            $('#design-modal').modal('hide');
                            designTable.draw();
                        }

                    },

                    error: function (reject) {
                        console.log('Error: not added', reject);
                        var response = $.parseJSON(reject.responseText);
                        $.each(response.errors, function (key, val) {
                            $("#" + key + "_error").text(val[0]);


                        });

                    }

                });
            });

            //Delete

            $('body').on('click', '.deleteDesign', function () {
                var id = $(this).data('id');
                $('#delete-modal').modal('show');

                $('#delete').click(function (e) {
                    e.preventDefault();
                    $.ajax({

                        url: "delete/" + id,

                        success: function (data) {
                            console.log('success:', data);
                            if (data.status == true) {
                                $('#delete-modal').modal('hide');
                                toastr.warning(data.msg);
                                designTable.draw();
                            } else {
                                $('#delete-modal').modal('hide');
                                toastr.error(data.msg);
                                designTable.draw();
                            }

                        }

                    });
                });

                $('#cancel').click(function () {
                    $('#delete-modal').modal('hide');
                });
            });

        });
    </script>
@endsection
