@extends('admin.layouts.master')

@section('title', 'Category List Page')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Admin List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('category#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>Add Category
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>

                    @if (session('deleteSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-xmark"></i> {{ session('deleteSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-3">
                            <h4 class="text-secondary">Search Key : <span class="text-danger">{{ request('key') }}</span></h4>
                        </div>
                        <div class="col-3 offset-9">
                            <form action="{{ route('admin#list') }}" method="get">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="key" class="form-control" placeholder="Search..." value="{{ request('key') }}">
                                    <button class="btn bg-dark text-white" type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-1 offset-10 bg-white shadow-sm py-2 px-2 text-center">
                            <h4><i class="fa-solid fa-database mr-2"> {{ $admin->total() }}</i></h4>
                        </div>
                    </div>


                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admin as $a)
                                        <tr class="tr-shadow">
                                            <td class="col-3">
                                                @if ($a->image == null)
                                                    @if ($a->gender == 'male')
                                                        <img src="{{ asset('image/default_user.jpg') }}" class="img-thumbnail shadow-sm" alt="">
                                                    @else
                                                        <img src="{{ asset('image/default_user_female.jpg') }}" class="img-thumbnail shadow-sm" alt="">
                                                    @endif
                                                @else
                                                   <img src="{{ asset('storage/'.$a->image) }}" class="img-thumbnail shadow-sm" alt="">
                                                @endif
                                            </td>
                                            <td>{{ $a->name }}</td>
                                            <td>{{ $a->email }}</td>
                                            <td>{{ $a->gender }}</td>
                                            <td>{{ $a->phone }}</td>
                                            <td>{{ $a->address }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    @if (Auth::user()->id == $a->id)

                                                    @else
                                                    <a href="{{ route('admin#changeRole',$a->id) }}">
                                                        <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Change Admin Role">
                                                            <i class="fa-solid fa-person-circle-minus"></i>
                                                        </button>
                                                   </a>

                                                       <a href="{{ route('admin#delete',$a->id) }}">
                                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                <i class="fa-solid fa-trash-can"></i>
                                                            </button>
                                                       </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="mt-3">
                                {{ $admin->links() }}
                            </div>
                        </div>

                        {{-- <h3 class="text-secondary text-center mt-5">There is no Category Here!</h3> --}}

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
