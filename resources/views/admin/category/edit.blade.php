@extends('layouts.admin_layout')
@section('title')
    SHopmama || Category View
@endsection
@section('category-info')
    show-sub active
@endsection
@section('category')
    active
@endsection
@section('content')
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
            <span class="breadcrumb-item active">Category List</span>
        </nav>

        <div class="sl-pagebody" style="min-height: 490px;">

            <div class="row row-sm">

                <div class="col-md-6 m-auto">
                    <div class="card">
                        <div class="card-header">Edit Category</div>
                        <div class="card-body">
                            <form action="{{ route('category.update', $category->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="form-control-label">Category Name English: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="category_name_en"
                                        value="{{ $category->category_name_en }}" placeholder="Enter Category Name English">
                                    @error('category_name_en')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Category Name Bangla: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="category_name_bn"
                                        value="{{ $category->category_name_bn }}" placeholder="Enter Category Name Bangla">
                                    @error('category_name_bn')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Category Icon: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="category_icon"
                                        value="{{ $category->category_icon }}" placeholder="Enter Category Icon">
                                    @error('category_icon')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-layout-footer">
                                    <button type="submit" class="btn btn-info">Update</button>
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
