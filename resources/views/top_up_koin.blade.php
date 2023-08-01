@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Top-Up Koin</div>

                    <div class="card-body text-center">
                        <h3>Koin Saat Ini: {{ $user->coins }}</h3>
                        <form action="{{ route('top-up.koin') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary">Top-Up 100 Koin</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection