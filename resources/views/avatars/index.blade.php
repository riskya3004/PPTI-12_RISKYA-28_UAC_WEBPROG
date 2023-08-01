@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Available Avatars</div>

                    <div class="card-body">
                        @foreach ($avatars as $avatar)
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <img src="{{ asset('storage/avatars/' . $avatar->name) }}" alt="Avatar" class="img-thumbnail">
                                </div>
                                <div class="col-md-6 d-flex align-items-center justify-content-center">
                                    <form action="{{ route('avatars.purchase', $avatar) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Purchase for {{ $avatar->price }} coins</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
