@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">SSCD</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <br>
                    <br>
                    <br>
                    <h1 class="text-center">¡Hola {{ Auth::user()->name }}!</h1>
                    <br>
                    <br>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
