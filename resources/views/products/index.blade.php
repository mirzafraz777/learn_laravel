<!doctype html>
<html lang="en">

<head>
    {{-- Required meta tags  --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap CSS  --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- font-awesome CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Laravel Project</title>
</head>

<body>
    <div class="container">
        <header
            class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <a href="{{route('productsAll')}}" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                <span class="fs-4">Laravel Project</span>
            </a>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="#" class="nav-link px-2 link-secondary">Home</a></li>
                <li><a href="#" class="nav-link px-2 link-dark">Features</a></li>
                <li><a href="#" class="nav-link px-2 link-dark">Pricing</a></li>
                <li><a href="#" class="nav-link px-2 link-dark">FAQs</a></li>
                <li><a href="#" class="nav-link px-2 link-dark">About</a></li>
            </ul>

            <div class="col-md-3 text-end">
                <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Login</a>
                <a href="{{ route('register') }}" class="btn btn-success">Register</a>
            </div>
        </header>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center">List of Products</h2>
            </div>
            <div class="col-12">

            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="d-flex justify-content-start">
                    @if (session()->has('message'))
                        <div class="alert alert-success d-flex align-items-center" role="alert">
                            <div>{{ session('message') }}</div>
                        </div>
                    @endif
                </div>    
            </div>
            <div class="col-md-6">            
                <div class="d-flex justify-content-end">
                    <div class="d-flex align-items-center">
                        <a href="{{route('productsCreate')}}" class="btn btn-outline-dark mb-3"><i class="fa-solid fa-plus"></i> Add New</a>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="table-responsive-md">

                    <table class="table table-hover">
                        {{-- <caption class="fw-bolder">Total Products: <span class="fs-6 fw-light"> 12</span></caption> --}}
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">SKU</th>
                                <th scope="col">Price</th>
                                <th scope="col">Description</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 1;
                            @endphp
                            @foreach ($products as $product)
                            <tr>
                                <th scope="row">{{$count++}}</th>
                                <td> {{$product->title }} <a href="{{route('productsShow',$product->id)}}"> <i class="fa-solid fa-up-right-from-square"></i> </a></td>
                                <td>{{$product->sku }}</td>
                                <td>{{'$'.$product->price }}</td>
                                <td>{{$product->description }}</td>
                                <td>
                                    <a href="{{route('productsEdit',$product->id)}}" class="btn btn-outline-secondary">Edit</a>
                                    <form class="d-inline" action="{{route('productsDelete',$product->id)}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <input class="btn btn-outline-danger" type="submit" value="Delete">
                                    </form>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
                

            </div>
        </div>

    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    {{-- font-awesome --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    -->
</body>

</html>
