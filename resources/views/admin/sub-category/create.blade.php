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
                <a class="btn btn-primary" style="margin-left: 787px;" href="{{ route('sub-category.view') }}"><i class="fa fa-list" aria-hidden="true"></i> List View</a>
        </nav>
        <div class="sl-pagebody" style="min-height: 490px;">

            <div class="row row-sm">
                <div class="col-md-6 m-auto">
                    <div class="card">
                        <div class="card-header">{{ @$editData ? 'Edit Sub Category' : 'Add New Sub Category' }}</div>
                        <div class="card-body">
                            <form method="post" action="{{ @$editData ? route('sub-category.update', $editData->id) : route('sub-category.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label class="form-control-label">Category Name: <span
                                            class="tx-danger">*</span></label>
                                    <select name="category_id" class="form-control select2-show-search"
                                        data-placeholder="Choose one (with searchbox)">
                                        <option label="Choose one"></option>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}" {{ (@$editData->category_id == $item->id) ? 'selected' : '' }}>{{ $item->category_name_en }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Sub Category Name English: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="sub_category_name_en"
                                        value="{{ @$editData ? $editData->sub_category_name_en : old('sub_category_name_en') }}"
                                        placeholder="Enter Sub Category Name English" >
                                    @error('sub_category_name_en')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Sub Category Name Bangla: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="sub_category_name_bn"
                                        value="{{ @$editData ? $editData->sub_category_name_bn : old('sub_category_name_bn') }}"
                                        placeholder="Enter Sub Category Name Bangla">
                                    @error('sub_category_name_bn')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-layout-footer">
                                    <button type="submit" class="btn btn-info">{{ @$editData ? 'Update' : 'Add New' }}</button>
                                </div><!-- form-layout-footer -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- sl-pagebody -->
        @include('admin.inc.footer')
    </div><!-- sl-mainpanel -->
@endsection
