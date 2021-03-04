@extends('layouts.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> التجار </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية </a></li>
                                <li class="breadcrumb-item active"> التجار</li>
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
                                       id="addNewVendor"><i class="la la-plus"></i>  اضافة تاجر جديد</a>
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

                                <div class="card-content collapse show" id="viewVendors">
                                    <div class="card-body card-dashboard table-responsive">
                                        <table class="table vendor-table">
                                            <thead>
                                            <tr>
                                                <th>اسم الشركة</th>
                                                <th>موقع الشركة</th>
                                                <th>رقم السجل التجاري</th>
                                                <th>رقم الجوال</th>
                                                <th>الهوية الوطنية</th>
                                                <th>الايميل</th>
                                                <th>نوع النشاط</th>
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

    <div class="modal fade modal-open" id="vendor-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content width-800">
                <div class="modal-header">
                    <h4 class="modal-title form-section" id="modalheader">
                        <i class="ft-home"></i> اضافة تاجر
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <form class="form" id="vendorForm" enctype="multipart/form-data">
                                @csrf

                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> اسم الشركة </label>
                                                <input type="text" id="company_name" class="form-control" placeholder="مثال:شركة المدينة المنورة"
                                                       name="company_name" value="{{old('company_name')}}">
                                                <span id="company_name_error" class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> موقع الشركة </label>
                                                <input type="text" id="location" class="form-control" placeholder="مثال:الرياض"
                                                       name="location" value="{{old('location')}}">
                                                <span id="location_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> رقم السجل النجاري </label>
                                                <input type="number" id="commercial_registration_No" class="form-control" placeholder="مثال:5658"
                                                       name="commercial_registration_No" value="{{old('commercial_registration_No')}}">
                                                <span id="commercial_registration_No_error" class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> رقم الجوال </label>
                                                <input type="number" id="mobile_No" class="form-control" placeholder="مثال:0599664473"
                                                       name="mobile_No" value="{{old('mobile_No')}}">
                                                <span id="mobile_No_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> الهوية الوطنية </label>
                                                <input type="number" id="national_Id" class="form-control" placeholder="مثال:505990014"
                                                       name="national_Id" value="{{old('national_Id')}}">
                                                <span id="national_Id_error" class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> الايميل </label>
                                                <input type="email" id="email" class="form-control" placeholder="مثال:almadina@gmail.com"
                                                       name="email" value="{{old('email')}}">
                                                <span id="email_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="projectinput2"> نوع النشاط </label>
                                                <select name="type_activity" id="type_activity" class="select form-control">
                                                    <optgroup label="حدد نوع النشاط">
                                                        <option value="تفصيل">تفصيل</option>
                                                        <option value="أقمشة">أقمشة</option>
                                                        <option value="الاثنين معا">الاثنين معا</option>
                                                    </optgroup>
                                                </select>
                                                <span id="type_activity_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">كلمة السر </label>
                                                <input type="password" id="password" class="form-control" placeholder="مثال:******"
                                                       name="password" value="{{old('password')}}">
                                                <span id="password_error" class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> تأكيد كلمة المرور </label>
                                                <input type="password" id="password_confirmation" class="form-control" placeholder="مثال:******"
                                                       name="password_confirmation" value="{{old('password_confirmation')}}">
                                                <span id="password_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-actions">
                                    <input type="hidden" name="action" id="action" value="Add">
                                    <button type="button" class="btn btn-warning mr-1" data-dismiss="modal"><i
                                            class="la la-undo"></i> تراجع
                                    </button>
                                    <button class="btn btn-primary" id="addVendor"><i class="la la-save"></i> حفظ</button>
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
                        <h5>هل أنت متأكد من حذف هذا التاجر !!</h5>
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
            var vendorTable = $('.vendor-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route("index.vendors")}}",
                columns: [
                    {data: 'company_name', name: 'company_name'},
                    {data: 'location', name: 'location'},
                    {data: 'commercial_registration_No', name: 'commercial_registration_No'},
                    {data: 'mobile_No', name: 'mobile_No'},
                    {data: 'national_Id', name: 'national_Id'},
                    {data: 'email', name: 'email'},
                    {data: 'type_activity', name: 'type_activity'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });


            //Show Form
            $('#addNewVendor').click(function () {
                $('#vendorForm').trigger('reset');
                $('#vendor-modal').modal('show');

            });


            //Add Or Update
            $(document).on('click', '#addVendor', function (e) {
                e.preventDefault();
                var formData = new FormData($('#vendorForm')[0]);
                $('#company_name_error').text('');
                $('#location_error').text('');
                $('#commercial_registration_No_error').text('');
                $('#mobile_No_error').text('');
                $('#national_Id_error').text('');
                $('#email_error').text('');
                $('#type_activity_error').text('');
                $('#password_error').text('');
                $.ajax({
                    type: 'post',
                    url: "{{ route('save.vendor') }}",
                    enctype: 'multipart/form-data',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: 'json',

                    success: function (data) {
                        if (data.status == true) {
                            toastr.success(data.msg);
                            $('#vendorForm').trigger('reset');
                            $('#vendor-modal').modal('hide');
                            vendorTable.draw();
                        } else {
                            toastr.error(data.msg);
                            $('#vendorForm').trigger('reset');
                            $('#vendor-modal').modal('hide');
                            vendorTable.draw();
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

            $('body').on('click', '.deleteVendor', function () {
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
                                vendorTable.draw();
                            } else {
                                $('#delete-modal').modal('hide');
                                toastr.error(data.msg);
                                vendorTable.draw();
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
