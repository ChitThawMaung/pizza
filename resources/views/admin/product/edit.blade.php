@extends('admin.layouts.master')

@section('title', 'Category List Page')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="row">
            <div class="col-5 offset-6 mb-2">
                @if (session('updateSuccess'))
                <div class="">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-check"></i> {{ session('updateSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                </div>
            @endif
            </div>
        </div>


        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="ms-3">
                                <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i>
                            </div>
                            <div class="card-title">
                                <h3 class="text-center title-2">Pizza Details</h3>
                            </div>

                            @if (session('changeSuccess'))
                                <div class="col-12">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="fa-solid fa-cloud-arrow-down me-2"></i> {{ session('changeSuccess') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif

                            @if (session('notMatch'))
                                <div class="col-12">
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <i class="fa-solid fa-triangle-exclamation me-2"></i> {{ session('notMatch') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif
                            <hr>

                            <div class="row">
                                <div class="col-3 offset-2">
                                    <img src="{{ asset('storage/'.$pizza->image) }}" class="img-thumbnail shadow-sm" alt="">
                                </div>
                                <div class="col-7">
                                    <h3 class="my-3 btn btn-danger text-white d-block w-50 fs-5 text-center">{{ $pizza->name }}</h3>

                                    <span class="my-3 btn bg-dark text-white"><i class="fa-solid fa-money-bill-1-wave me-2"></i>{{ $pizza->price }} Kyats
                                    </span>

                                    <span class="my-3 btn bg-dark text-white"><i class="fa-solid fa-clock me-2"></i>{{ $pizza->waiting_time }} mins</span>

                                    <span class="my-3 btn bg-dark text-white"><i
                                    class="fa-solid fa-eye me-2"></i>{{ $pizza->view_count }}</span>

                                    <span class="my-3 btn bg-dark text-white"><i
                                        class="fa-solid fa-coin me-2"></i>{{ $pizza->category_name }}</span>

                                    <div class="my-3 btn bg-dark text-white"><i
                                        class="fa-solid fa-user-clock me-2"></i>{{ $pizza->created_at->format('j-F-Y') }}</div>

                                    <div class="my-3"><i
                                        class="fa-solid fa-file-lines me-2"></i>Details</div>

                                    <div class="">{{ $pizza->description }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
