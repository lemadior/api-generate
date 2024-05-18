@extends('layouts.main')

@section('content')
<main class="main">
    <div class="container">
        <div class="page__text">
            <div>
                <img src="{{ asset('assets/images/LOGO.png') }}" alt="logo">
            </div>
            <div class="col-md-5">
            <p>
                Random number generation service.
            </p>
            <p>
                <h4>Specifications:</h4>
                <ol>
                    <li>
                        REST API for random number generation.
                    </li>
                    <li>
                        The unique <code>id</code> by which you can get the result generation.
                    </li>
                    <li>
                        Two public API methods: <code>generate()</code> and <code>retrieve(id)</code>.
                    </li>
                </ol>
            </p>

            <p>
                <a href="{{ url('/api/v1/documentation') }}" class="btn btn-success">Api documentation</a>
            </p>
            </div>
        </div>
    </div>

</main>

@endsection
