@extends('admin.dashbord')

@section('content')

    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class=" container ">
            <!--begin::Notice-->
            
            <div class="alert-text">
                    @include('admin.languages.createLanguage')
                </div>
            <!--end::Notice-->

            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header flex-wrap py-5">
                    <div class="card-title">
                        <h3 class="card-label">
                            Languages
                            <span class="text-muted pt-2 font-size-sm d-block">All Languagegs</span>
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Dropdown-->
                        <div class="dropdown dropdown-inline mr-2">
                            <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-download"></i> Export
                            </button>
                            <!--begin::Dropdown Menu-->
                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <ul class="nav flex-column nav-hover">
                                    <li class="nav-header font-weight-bolder text-uppercase  text-primary pb-2">
                                        Choose an option:
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon la la-print"></i>
                                            <span class="nav-text">Print</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon la la-copy"></i>
                                            <span class="nav-text">Copy</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon la la-file-excel-o"></i>
                                            <span class="nav-text">Excel</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon la la-file-text-o"></i>
                                            <span class="nav-text">CSV</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon la la-file-pdf-o"></i>
                                            <span class="nav-text">PDF</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!--end::Dropdown Menu-->
                        </div>
                        <!--end::Dropdown-->

                        <!--begin::Button-->
                        <a href="#" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#lang_form">
                            <i class="la la-plus"></i>
                            New Record
                        </a>
                        <!--end::Button-->
                    </div>
                </div>
                <div class="card-body">
                    <!--begin: Datatable-->
                    <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="row py-3">
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_length" id="kt_datatable_length"><label>Show <select
                                            name="kt_datatable_length" aria-controls="kt_datatable"
                                            class="custom-select custom-select-sm form-control form-control-sm">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select> entries</label></div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div id="kt_datatable_filter" class="dataTables_filter"><label>Search:<input type="search"
                                            class="form-control form-control-sm" placeholder=""
                                            aria-controls="kt_datatable"></label></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_info" id="kt_datatable_info" role="status" aria-live="polite">
                                    Showing 1 to 10 of 50 entries</div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_paginate paging_simple_numbers" id="kt_datatable_paginate">
                                    <ul class="pagination">
                                        <li class="paginate_button page-item previous disabled"
                                            id="kt_datatable_previous"><a href="#" aria-controls="kt_datatable"
                                                data-dt-idx="0" tabindex="0" class="page-link"><i
                                                    class="ki ki-arrow-back"></i></a></li>
                                        <li class="paginate_button page-item active"><a href="#"
                                                aria-controls="kt_datatable" data-dt-idx="1" tabindex="0"
                                                class="page-link">1</a></li>
                                        <li class="paginate_button page-item "><a href="#"
                                                aria-controls="kt_datatable" data-dt-idx="2" tabindex="0"
                                                class="page-link">2</a></li>
                                        <li class="paginate_button page-item "><a href="#"
                                                aria-controls="kt_datatable" data-dt-idx="3" tabindex="0"
                                                class="page-link">3</a></li>
                                        <li class="paginate_button page-item "><a href="#"
                                                aria-controls="kt_datatable" data-dt-idx="4" tabindex="0"
                                                class="page-link">4</a></li>
                                        <li class="paginate_button page-item "><a href="#"
                                                aria-controls="kt_datatable" data-dt-idx="5" tabindex="0"
                                                class="page-link">5</a></li>
                                        <li class="paginate_button page-item next" id="kt_datatable_next"><a
                                                href="#" aria-controls="kt_datatable" data-dt-idx="6"
                                                tabindex="0" class="page-link"><i class="ki ki-arrow-next"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row py-3">
                            <div class="col-sm-12">
                                <table class="table table-separate table-head-custom table-checkable dataTable no-footer"
                                    id="kt_datatable" aria-describedby="kt_datatable_info" role="grid"
                                    style="width: 1079px;">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="kt_datatable"
                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                aria-label="Record ID: activate to sort column descending"
                                                style="width: 56px;">ID</th>




                                            <th class="sorting" tabindex="0" aria-controls="kt_datatable"
                                                rowspan="1" colspan="1"
                                                aria-label="Company Name: activate to sort column ascending"
                                                style="width: 69px;"> Name</th>
                                            <th class="sorting" tabindex="0" aria-controls="kt_datatable"
                                                rowspan="1" colspan="1"
                                                aria-label="Ship Date: activate to sort column ascending"
                                                style="width: 47px;">Direction</th>
                                            <th class="sorting" tabindex="0" aria-controls="kt_datatable"
                                                rowspan="1" colspan="1"
                                                aria-label="Ship Date: activate to sort column ascending"
                                                style="width: 47px;">Abrrviation</th>
                                            <th class="sorting" tabindex="0" aria-controls="kt_datatable"
                                                rowspan="1" colspan="1"
                                                aria-label="Status: activate to sort column ascending"
                                                style="width: 58px;">Status</th>
                                            <th class="sorting" tabindex="0" aria-controls="kt_datatable"
                                                rowspan="1" colspan="1"
                                                aria-label="Type: activate to sort column ascending" style="width: 32px;">
                                                Type</th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1"
                                                aria-label="Actions" style="width: 105px;">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($data as $d)
                                            <tr class="odd">
                                                <td class="sorting_1">{{ $d->id }}</td>
                                                <td>{{ $d->name }}</td>
                                                <td>{{ $d->dir }}</td>
                                                <td>{{ $d->abbr }}</td>

                                                <td>
                                                    @if ($d->active == 1)
                                                        <span
                                                            class="label label-lg font-weight-bold  label-light-info label-inline"></span>
                                                    @else
                                                        <span
                                                            class="label label-lg font-weight-bold  label-light-danger label-inline">Delivered</span>
                                                    @endif


                                                </td>

                                                <td nowrap="">
                                                    <div class="dropdown dropdown-inline"> <a href="javascript:;"
                                                            class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
                                                            <i class="la la-cog"></i> </a>
                                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                            <ul class="nav nav-hoverable flex-column">
                                                                <li class="nav-item"><a class="nav-link"
                                                                        href="#"><i
                                                                            class="nav-icon la la-edit"></i><span
                                                                            class="nav-text">Edit Details</span></a></li>
                                                                <li class="nav-item"><a class="nav-link"
                                                                        href="#"><i
                                                                            class="nav-icon la la-leaf"></i><span
                                                                            class="nav-text">Update Status</span></a></li>
                                                                <li class="nav-item"><a class="nav-link"
                                                                        href="#"><i
                                                                            class="nav-icon la la-print"></i><span
                                                                            class="nav-text">Print</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div> <a href="javascript:;" class="btn btn-sm btn-clean btn-icon"
                                                        title="Edit details"> <i class="la la-edit"></i> </a> <a
                                                        href="javascript:;" class="btn btn-sm btn-clean btn-icon"
                                                        title="Delete"> <i class="la la-trash"></i> </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        {{-- <tr class="even">
                                            <td class="sorting_1">2</td>
                                            <td>54868-3377</td>
                                            <td>Vietnam</td>
                                            <td>Bình Minh</td>
                                            <td>8998 Delaware Court</td>
                                            <td>Humbert Bresnen</td>
                                            <td>Hodkiewicz and Sons</td>
                                            <td>4/24/2016</td>
                                            <td><span
                                                    class="label label-lg font-weight-bold  label-light-danger label-inline">Delivered</span>
                                            </td>
                                            <td><span class="label label-primary label-dot mr-2"></span><span
                                                    class="font-weight-bold text-primary">Retail</span></td>
                                            <td nowrap="">
                                                <div class="dropdown dropdown-inline"> <a href="javascript:;"
                                                        class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown"> <i
                                                            class="la la-cog"></i> </a>
                                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                        <ul class="nav nav-hoverable flex-column">
                                                            <li class="nav-item"><a class="nav-link" href="#"><i
                                                                        class="nav-icon la la-edit"></i><span
                                                                        class="nav-text">Edit Details</span></a></li>
                                                            <li class="nav-item"><a class="nav-link" href="#"><i
                                                                        class="nav-icon la la-leaf"></i><span
                                                                        class="nav-text">Update Status</span></a></li>
                                                            <li class="nav-item"><a class="nav-link" href="#"><i
                                                                        class="nav-icon la la-print"></i><span
                                                                        class="nav-text">Print</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div> <a href="javascript:;" class="btn btn-sm btn-clean btn-icon"
                                                    title="Edit details"> <i class="la la-edit"></i> </a> <a
                                                    href="javascript:;" class="btn btn-sm btn-clean btn-icon"
                                                    title="Delete"> <i class="la la-trash"></i> </a>
                                            </td>
                                        </tr> --}}
                                    </tbody>

                                </table>
                            </div>
                        </div>
                        {{-- <div class="row py-3">
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_length"><label>Show <select name="kt_datatable_length"
                                            aria-controls="kt_datatable"
                                            class="custom-select custom-select-sm form-control form-control-sm">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select> entries</label></div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_filter"><label>Search:<input type="search"
                                            class="form-control form-control-sm" placeholder=""
                                            aria-controls="kt_datatable"></label></div>
                            </div>
                        </div> --}}
                        {{-- <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info">Showing 1 to 10 of 50 entries</div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers">
                                    <ul class="pagination">
                                        <li class="paginate_button page-item previous disabled"><a href="#"
                                                aria-controls="kt_datatable" data-dt-idx="0" tabindex="0"
                                                class="page-link"><i class="ki ki-arrow-back"></i></a></li>
                                        <li class="paginate_button page-item active"><a href="#"
                                                aria-controls="kt_datatable" data-dt-idx="1" tabindex="0"
                                                class="page-link">1</a></li>
                                        <li class="paginate_button page-item "><a href="#"
                                                aria-controls="kt_datatable" data-dt-idx="2" tabindex="0"
                                                class="page-link">2</a></li>
                                        <li class="paginate_button page-item "><a href="#"
                                                aria-controls="kt_datatable" data-dt-idx="3" tabindex="0"
                                                class="page-link">3</a></li>
                                        <li class="paginate_button page-item "><a href="#"
                                                aria-controls="kt_datatable" data-dt-idx="4" tabindex="0"
                                                class="page-link">4</a></li>
                                        <li class="paginate_button page-item "><a href="#"
                                                aria-controls="kt_datatable" data-dt-idx="5" tabindex="0"
                                                class="page-link">5</a></li>
                                        <li class="paginate_button page-item next"><a href="#"
                                                aria-controls="kt_datatable" data-dt-idx="6" tabindex="0"
                                                class="page-link"><i class="ki ki-arrow-next"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <!--end: Datatable-->
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
@endsection
