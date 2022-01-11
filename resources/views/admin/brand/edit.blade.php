@extends('layouts.admin_layout')
@section('title')
    SHopmama || Brand View
@endsection
@section('brand')
    active
@endsection
@section('content')
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
            <span class="breadcrumb-item active">Brand Edit</span>
        </nav>

        <div class="sl-pagebody" style="min-height: 490px;">

            <div class="row row-sm">
                <div class="col-md-6 m-auto">
                    <div class="card">
                        <div class="card-header">Edit Brand</div>
                        <div class="card-body">
                            <form action="{{ route('brand.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="form-control-label">Brand Name English: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="brand_name_en"
                                        value="{{ $brand->brand_name_en }}" placeholder="Enter Brand Name English">
                                    @error('brand_name_en')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Brand Name Bangla: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="brand_name_bn"
                                        value="{{ $brand->brand_name_bn }}" placeholder="Enter Brand Name Bangla">
                                    @error('brand_name_bn')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Brand Image: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" type="file" name="brand_image"
                                        >
                                    @error('brand_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <img src="{{ asset( $brand->brand_image ) }}" width="90px" height="90px" alt="{{ __('image') }}">
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
