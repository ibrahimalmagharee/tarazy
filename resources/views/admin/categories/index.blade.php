@extends('layouts.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> الاقسام </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية </a></li>
                                <li class="breadcrumb-item active"> الاقسام</li>
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
                                       id="addNewCategory"><i class="la la-plus"></i>  اضافة قسم جديد</a>
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

                                <div class="card-content collapse show" id="viewCategory">
                                    <div class="card-body card-dashboard table-responsive">
                                        <table class="table category-table">
                                            <thead>
                                            <tr>
                                                <th>الاسم</th>
                                                <th>القسم الرئيسي</th>
                                                <th>الحالة</th>
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

    <div class="modal fade modal-open" id="category-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content width-500">
                <div class="modal-header">
                    <h4 class="modal-title form-section" id="modalheader">
                        <i class="ft-home"></i> الاقسام
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <form class="form" id="categoryForm" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mt-1">
                                                <input type="radio" name="type" value="1"
                                                       class="switchery" data-color="success" checked/>
                                                <label class="card-title ml-1">قسم رئيسي</label>

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mt-1">
                                                <input type="radio" name="type" value="2"
                                                       class="switchery" data-color="success"/>
                                                <label class="card-title ml-1">قسم فرعي</label>

                                            </div>
                                        </div>
                                    </div>

                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="projectinput1">الاسم </label>
                                                <input type="text" id="name" class="form-control" placeholder="مثال:التصاميم , الاقمشة ..."
                                                       name="name" value="{{old('name')}}">
                                                <span id="name_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row hidden" id="categories_list">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="projectinput2"> اختر القسم </label>
                                                <select name="parent_id" id="parent_id" class="form-control ">
                                                    <optgroup label="الرجاء اختر القسم الرئيسي ">
                                                        @isset($categories)
                                                            @foreach($categories as $main_category)
                                                                <option value="{{$main_category->id}}">{{$main_category->name}}</option>
                                                            @endforeach
                                                        @endisset

                                                    </optgroup>
                                                </select>
                                                <span id="parent_id_error" class="text-danger"></span>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group mt-1">
                                                <label for="switcheryColor4" class="card-title ml-1">الحالة</label>
                                                <input type="checkbox" name="is_active" value="1" id="switcheryColor4"
                                                       class="switchery active" data-color="success" checked/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>

                                <div class="form-actions">
                                    <input type="hidden" name="action" id="action" value="Add">
                                    <button type="button" class="btn btn-warning mr-1" data-dismiss="modal"><i
                                            class="la la-undo"></i>تراجع
                                    </button>
                                    <button class="btn btn-primary" id="addCategory"> <i class="la la-save"></i> حفظ</button>
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
                        <h5>هل أنت متأكد من حذف هذا القسم !!</h5>
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

            $('input:radio[name="type"]').change(
                function () {
                    if (this.checked && this.value == 2){
                        $('#categories_list').removeClass('hidden');
                    }else{
                        $('#categories_list').addClass('hidden');
                    }
                });


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //Show Table
            var categoryTable = $('.category-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route("index.categories")}}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'parent_id', name: 'parent_id'},
                    {data: 'is_active', name: 'is_active'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });


            //Show Form
            $('#addNewCategory').click(function () {
                $('#categoryForm').trigger('reset');
                $('#category-modal').modal('show');

            });


            //Add Or Update
            $(document).on('click', '#addCategory', function (e) {
                e.preventDefault();
                var formData = new FormData($('#categoryForm')[0]);
                $('#name_error').text('');
                $('#parent_id_error').text('');
                $.ajax({
                    type: 'post',
                    url: "{{ route('save.category') }}",
                    enctype: 'multipart/form-data',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: 'json',

                    success: function (data) {
                        if (data.status == true) {
                            toastr.success(data.msg);
                            $('#categoryForm').trigger('reset');
                            $('#category-modal').modal('hide');
                            categoryTable.draw();
                        } else {
                            toastr.error(data.msg);
                            $('#mainCategoryForm').trigger('reset');
                            $('#mainCategory-modal').modal('hide');
                            categoryTable.draw();
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

            $('body').on('click', '.deleteCategory', function () {
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
                                categoryTable.draw();
                            } else {
                                $('#delete-modal').modal('hide');
                                toastr.error(data.msg);
                                categoryTable.draw();
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
