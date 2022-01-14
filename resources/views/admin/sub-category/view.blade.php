@extends('layouts.admin_layout')
@section('title')
    SHopmama || Sub Category View
@endsection
@section('category-info')
    show-sub active
@endsection
@section('sub-category')
    active
@endsection
@section('content')
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
                <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span class="breadcrumb-item active">Sub Category List</span>
                <a class="btn btn-primary" style="margin-left: 787px;" href="{{ route('sub-category.create') }}"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New</a>
        </nav>
        <div class="sl-pagebody" style="min-height: 490px;">

            <div class="row row-sm">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header pull-left">Sub Category List</div>
                        {{-- <div class="card-header pull-right">Add New</div> --}}
                        <div class="card-body">
                            <div class="table-wrapper">
                                <table id="datatable1" class="table display nowrap">
                                    <thead>
                                        <tr>
                                            <th class="wd-10p">Sl No</th>
                                            <th class="wd-15p">Category Name</th>
                                            <th class="wd-25p">Sub Category name En</th>
                                            <th class="wd-25p">Sub Category name Bn</th>
                                            <th class="wd-10p">Status</th>
                                            <th class="wd-10p">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subcategories as $item)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $item->category->category_name_en }}</td>
                                                <td>{{ ucwords($item->sub_category_name_en) }}</td>
                                                <td>{{ $item->sub_category_name_bn }}</td>
                                                <td>
                                                    @if ($item->status == 1)
                                                        <span class="badge badge-success badge-pill">active</span>
                                                    @else
                                                        <span class="badge badge-danger badge-pill">inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ url('/admin/sub-category/edit/' . $item->id) }}"
                                                        class="btn btn-sm btn-primary" title="edit data"> <i
                                                            class="fa fa-pencil"></i></a>

                                                    <a href="{{ url('/admin/sub-category/delete/' . $item->id) }}"
                                                        class="btn btn-sm btn-danger" id="delete" title="delete data"><i
                                                            class="fa fa-trash"></i></a>
                                                    @if ($item->status == 1)
                                                        <a href="{{ url('/admin/sub-category/inactive/' . $item->id) }}"
                                                            class="btn btn-sm btn-success" title="active now"><i
                                                                class="fa fa-arrow-down"></i></a>
                                                    @else
                                                        <a href="{{ url('/admin/sub-category/active/' . $item->id) }}"
                                                            class="btn btn-sm btn-warning" title="inactive now"><i
                                                                class="fa fa-arrow-up"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div><!-- table-wrapper -->
                        </div>
                    </div><!-- card -->
                </div>
            </div>
        </div><!-- sl-pagebody -->
        @include('admin.inc.footer')
    </div><!-- sl-mainpanel -->
@endsection
