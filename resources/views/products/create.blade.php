<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Laravel Project</title>
</head>

<body>
    <div class="container">
        <header
            class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <a href="{{ route('productsAll') }}"
                class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
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
                <h2 class="text-center">Add New Product</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('productsAll') }}" class="btn btn-outline-dark float-end mb-3">Go Back</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-6 ">
                <div class="card text-dark bg-light mb-3 py-3">
                    <div class="card-body">
                        <form method="POST" action="{{ route('productsStore') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="productTitle" class="col-sm-3 col-form-label">Title</label>
                                <div class="col-sm-9">
                                    <input type="text" 
                                           class="form-control @error('title') is-invalid @enderror " 
                                           id="productTitle" 
                                           name="title"
                                           value="{{ old('title') }}"
                                           
                                    >
                                        @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="productSKU" class="col-sm-3 col-form-label">Code</label>
                                <div class="col-sm-9">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" >SKU</span>
                                        <input type="text" 
                                            class="form-control @error('sku') is-invalid @enderror " 
                                            id="productSKU" 
                                            name="sku"  
                                            value="{{ old('sku') }}"
                                            aria-label="Sizing example input"
                                            aria-describedby="productSKU"
                                            >
                                            @error('sku')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror    
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="productPrice" class="col-sm-3 col-form-label">Price</label>
                                <div class="col-sm-9">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">$</span>
                                        <input type="text"
                                        class="form-control @error('price') is-invalid @enderror" 
                                        id="productPrice" 
                                        name="price" 
                                        value="{{ old('price') }}"
                                        aria-label="Amount (to the nearest dollar)"
                                        >
                                        @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="productDescription" class="col-sm-3 col-form-label">Description</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="productDescription" 
                                              name="description" 
                                              cols="30" 
                                              rows="10"
                                              
                                              >{{ old('description') }}</textarea>
                                    @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

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
