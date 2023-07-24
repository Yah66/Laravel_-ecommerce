<div>
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class=" container ">
            <!--begin::Notice-->

            {{-- <div class="alert-text">
                @if ($addProduct)
                    @include('livewire.admin.product.createProduct')
                @endif
                @if ($updateProduct)
                    @include('livewire.admin.product.updateProduct')
                @endif
                @include('livewire.admin.product.deleteProduct')

            </div> --}}
            {{-- <div class="alert-text">
                @include('admin.includes.alerts.errors')
                @include('admin.includes.alerts.success')
            </div> --}}

            <!--end::Notice-->

            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header flex-wrap py-5">
                    {{-- <div class="card-title">
                        <h3 class="card-label">
                            {{ __('messages.product') }}
                            <span class="text-muted pt-2 font-size-sm d-block">{{ __('messages.all_products') }}</span>
                        </h3>
                    </div> --}}
                    <div class="card-toolbar">
                        <!--begin::Dropdown-->
                        <div class="dropdown dropdown-inline mr-2">
                            <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-download"></i> {{ __('messages.export') }}
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
                                            <i class="nav-icon la la-file-excel-o"></i>
                                            <span class="nav-text">Excel</span>
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
                        {{-- <a wire:click="addProduct()"class="btn btn-primary font-weight-bolder" data-toggle="modal"
                            data-target="#Product_form">
                            <i class="la la-plus"></i>
                            {{ __('messages.new_record') }}
                        </a> --}}
                        <!--end::Button-->
                    </div>
                </div>
                <div class="card-body">
                    <!--begin: Datatable-->
                    <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="row py-3">
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_length" id="kt_datatable_length"><label>{{ __('messages.show') }}
                                        <select name="kt_datatable_length" aria-controls="kt_datatable"
                                            class="custom-select custom-select-sm form-control form-control-sm">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select> entries</label></div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div id="kt_datatable_filter" class="dataTables_filter">
                                    <label>{{ __('messages.search') }}
                                        <input wire:model.debounce.300ms="search" type="search"
                                            class="form-control form-control-sm" placeholder="" />
                                    </label>
                                </div>
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
                                <table
                                    class="table table-separate table-head-custom table-checkable dataTable no-footer"
                                    id="kt_datatable" aria-describedby="kt_datatable_info" role="grid"
                                    style="width: 1079px;">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting sorting_asc" tabindex="0"
                                                aria-controls="kt_datatable" rowspan="1" colspan="1"
                                                aria-sort="ascending"
                                                aria-label="Record ID: activate to sort column descending"
                                                style="width: 56px;">{{ __('messages.id') }}</th>

                                            <th class="sorting" tabindex="0" aria-controls="kt_datatable"
                                                rowspan="1" colspan="1"
                                                aria-label=" Name: activate to sort column ascending"
                                                style="width: 69px;">{{ __('messages.name') }}
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="kt_datatable"
                                                rowspan="1" colspan="1"
                                                aria-label=" Name: activate to sort column ascending"
                                                style="width: 69px;">{{ __('messages.email') }}
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="kt_datatable"
                                                rowspan="1" colspan="1"
                                                aria-label=" price: activate to sort column ascending"
                                                style="width: 69px;">{{ __('messages.address') }}
                                            </th>

                                            <th class="sorting" tabindex="0" aria-controls="kt_datatable"
                                                rowspan="1" colspan="1"
                                                aria-label=" qty: activate to sort column ascending"
                                                style="width: 69px;">{{ __('messages.qty') }}
                                            </th>

                                            <th class="sorting" tabindex="0" aria-controls="kt_datatable"
                                                rowspan="1" colspan="1"
                                                aria-label="Image: activate to sort column ascending"
                                                style="width: 47px;">{{ __('messages.image') }}</th>


                                            <th class="sorting" tabindex="0" aria-controls="kt_datatable"
                                                rowspan="1" colspan="1"
                                                aria-label="Status: activate to sort column ascending"
                                                style="width: 58px;">Payment status</th>
                                            <th class="sorting" tabindex="0" aria-controls="kt_datatable"
                                                rowspan="1" colspan="1"
                                                aria-label=" qty: activate to sort column ascending"
                                                style="width: 69px;">Delivery Status
                                            </th>
                                            {{-- <th class="sorting_disabled" rowspan="1" colspan="1"
                                                aria-label="Actions" style="width: 105px;">
                                                {{ __('messages.action') }}
                                            </th> --}}
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($data as $d)
                                            {{-- <tr class="odd">
                                                <td class="sorting_1">{{ $d->id }}</td>
                                                <td>{{ $d->name }}</td>
                                                <td>{{ $d->email}}</td>
                                                <td>{{ $d->address}}</td>
                                                <td>{{ $d->price ??? address}}</td>
                                                <td>{{  }}</td>
                                                <td>{{ $d->qty }}</td>
                                                <td><img src="{{ asset('storage/' . $d->image) }}" alt="image"
                                                        height="55px" width="55px">
                                                </td>
{{ $d->qty }}

                                                <td>



                                                </td>

                                                <td nowrap="">


                            </div> <a wire:click="edit({{ $d->id }})" data-toggle="modal"
                                data-target="#updateProduct" class="btn btn-sm btn-clean btn-icon"
                                title="Edit details">
                                <i class="la la-edit"></i> </a>
                            <a title="Delete" wire:click="$set('productIdToDelete', {{ $d->id }})"
                                data-toggle="modal" data-target="#deleteProduct"
                                class="btn btn-sm btn-clean btn-icon" title="Delete">
                                <i class="la la-trash"></i> </a>
                            </td> --}}
                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table>
                            </div>
                        </div>

                    </div>
                    <!--end: Datatable-->
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
</div>
