@extends('layouts.admin.index')

@section('content')
<div class="app-content content">
    <div class="content-wrapper mt-5">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
            <div class="content-header-left col-md-4 col-12 mb-2">
                <h3 class="content-header-title">Input Product</h3>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic Inputs start -->
            <section class="basic-inputs">
                <div class="row match-height">
                    <div class="col-xl-12 col-lg-6 col-md-12">
                        <form class="card" action="{{ route('addProd') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-block">
                                <div class="card-body">
                                    <h5 class="mt-2">Nama Product</h5>
                                    <fieldset class="form-group">
                                        <input type="text" class="form-control" id="nameProd" name="nameProd">
                                    </fieldset>
                                    <h5 class="mt-2">Category Product</h5>
                                    <fieldset class="form-group">
                                        <select name="catProd" id="catProd">
                                            <option value="1">1 / Futsal</option>
                                            <option value="2">2 / Football</option>
                                        </select>
                                    </fieldset>
                                    <h5 class="mt-2">Image Product</h5>
                                    <fieldset class="form-group">
                                        <span class="sr-only">Choose File</span>
                                        <input type="file" class="form-control" id="imgProd" name="img" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                                    </fieldset>
                                    <h5 class="mt-2">Price Product</h5>
                                    <fieldset class="form-group">
                                        <input type="text" class="form-control" id="priceProd" name="priceProd">
                                    </fieldset>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
