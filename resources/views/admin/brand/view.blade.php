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
            <span class="breadcrumb-item active">Brand List</span>
        </nav>

        <div class="sl-pagebody" style="min-height: 490px;">

            <div class="row row-sm">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Brand List</div>
                        <div class="card-body">
                            <div class="table-wrapper">
                                <table id="datatable1" class="table display responsive nowrap table-responsive">
                                    <thead>
                                        <tr>
                                            <th class="wd-10p">Sl No</th>
                                            <th class="wd-10p">Image</th>
                                            <th class="wd-25p">Brand name En</th>
                                            <th class="wd-25p">Brand name Bn</th>
                                            <th class="wd-10p">Status</th>
                                            <th class="wd-20p">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($brands as $item)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>
                                                    <img src="{{ asset( $item->brand_image ) }}" width="80px" height="60px" alt="{{ __('image') }}">
                                                </td>
                                                <td>{{ ucwords($item->brand_name_en) }}</td>
                                                <td>{{ $item->brand_name_bn }}</td>
                                                <td>
                                                    @if ($item->status == 1)
                                                        <span class="badge badge-success badge-pill">active</span>
                                                    @else
                                                        <span class="badge badge-danger badge-pill">inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('brand.edit',$item->id) }}"
                                                        class="btn btn-sm btn-primary" title="edit data"> <i
                                                            class="fa fa-pencil"></i></a>

                                                    <a href="{{ route('brand.delete',$item->id) }}"
                                                        class="btn btn-sm btn-danger" id="delete" title="delete data"><i
                                                            class="fa fa-trash"></i></a>
                                                    @if ($item->status == 1)
                                                        <a href="{{ route('brand.inactive',$item->id) }}"
                                                            class="btn btn-sm btn-success" title="active now"><i
                                                                class="fa fa-arrow-down"></i></a>
                                                    @else
                                                        <a href="{{ route('brand.active',$item->id) }}"
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
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Add New Brand</div>
                        <div class="card-body">
                            <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="form-control-label">Brand Name English: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="brand_name_en"
                                        value="{{ old('brand_name_en') }}" placeholder="Enter Brand Name English">
                                    @error('brand_name_en')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Brand Name Bangla: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="brand_name_bn"
                                        value="{{ old('brand_name_bn') }}" placeholder="Enter Brand Name Bangla">
                                    @error('brand_name_bn')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Brand Image: <span
                                            class="tx-danger">*</span></label>
                                    <input id="image" class="form-control" type="file" name="brand_image"
                                        >
                                        {{-- <input class="form-control" type="file" name="brand_image" value=""
                                    onchange="brandImageUrl(this)"> --}}
                                    @error('brand_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    {{-- <img src="" id="brand_image"> --}}
                                </div>

                                {{-- <div class="form-group">
                                    <img id="showImage" src="" width="80px" height="80px" alt="">
                                </div> --}}
                                <div class="form-layout-footer">
                                    <button type="submit" class="btn btn-info">Add New</button>
                                </div><!-- form-layout-footer -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- sl-pagebody -->
        @include('admin.inc.footer')
    </div><!-- sl-mainpanel -->

    <script src="{{ asset('common/jquery-2.2.4.min.js') }}"></script>
    <script>
        function brandImageUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#brand_image').attr('src', e.target.result).width(80)
                        .height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
