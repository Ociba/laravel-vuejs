@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> 
                <a href="/home">Dashboard</a>
                <a href="/product">Product</a>
                <a href="/breed">Breed</a>
                <a href="/category">Category</a>  
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <category-component></category-component>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
