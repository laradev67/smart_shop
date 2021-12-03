@extends('master')

@section('title')
    Manage Sub Category
@endsection

@section('body')

    {{-- For Message Show --}}
    @if ($message = Session::get('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Create New Sub Category</h4>
                    <form action="{{ route('sub-category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row mb-4">
                            <label class="col-sm-2 col-form-label">Category name</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="category_id">
                                    <option value="" disabled selected >--- Select Category ---</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="horizontal-firstname-input" class="col-sm-2 col-form-label">Sub Category name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="horizontal-firstname-input">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="horizontal-firstname-input1" class="col-sm-2 col-form-label">Sub Category
                                Description</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="description"
                                    id="horizontal-firstname-input1"></textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="horizontal-email-input2" class="col-sm-2 col-form-label">Sub Category Image</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control-file" name="image" id="horizontal-email-input2">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-sm-2">Publication Status</label>
                            <div class="col-sm-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" checked type="radio" name="status" id="inlineRadio1"
                                        value="1">
                                    <label class="form-check-label" for="inlineRadio1">Published</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="0">
                                    <label class="form-check-label" for="inlineRadio2">Unpublished</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-10">
                                <div>
                                    <button type="submit" class="btn btn-primary w-md">Create New Sub Category</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Data Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">All Sub Category Info Goes Here</h4>
                    <hr />
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>SL NO</th>
                                <th>Category Name</th>
                                <th>Sub Category Name</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- show category info --}}
                            @foreach ($sub_categries as $sub_category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $sub_category->category->name }}</td>
                                    <td>{{ $sub_category->name }}</td>
                                    <td>{{ $sub_category->description }}</td>
                                    <td><img src="{{ asset($sub_category->image) }}" alt="" height="40" width="60"></td>
                                    <td>{{ $sub_category->status == 1 ? 'Published' : 'Unpublished' }}</td>
                                    <td class="text-right">
                                        {{-- category status --}}
                                        <a href="{{ route('sub-category.update-status', ['id' => $sub_category->id]) }}"
                                            class="btn btn-sm {{ $sub_category->status == 1 ? 'btn-info' : 'btn-warning' }}"><i
                                                class="fas fa-arrow-circle-up"></i></a>
                                        {{-- category edit --}}
                                        <a href="{{ route('sub-category.edit', $sub_category->id) }}"
                                            class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                        {{-- category delete --}}
                                        <a href="" class="btn btn-danger btn-sm"
                                            onclick="event.preventDefault(); document.getElementById('subCategoryForm{{ $sub_category->id }}').submit();">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <form method="POST" action="{{ route('sub-category.destroy', $sub_category->id) }}"
                                            id="subCategoryForm{{ $sub_category->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    <!-- End Data Table-->
@endsection
