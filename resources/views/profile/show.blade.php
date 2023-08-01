@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('User Profile') }}</div>

                    <div class="card-body">
                        <!-- User's Profile Information -->
                        <div class="row mb-4">
                            <div class="col-md-4">
                                @if ($user->visible)
                                    <img src="{{ $user->avatar_url }}" alt="Profile Photo" class="img-thumbnail">
                                @else
                                    <img src="{{ asset('path/to/bear/photos/' . $user->bear_photo) }}" alt="Bear Photo" class="img-thumbnail">
                                @endif
                                <form action="{{ route('settings.set_random_bear_photo') }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary mt-2">Atur Foto Beruang Acak</button>
                                </form>
                            </div>
                            <div class="col-md-8">
                                <h4>{{ $user->name }}</h4>
                                <p>Username: {{ $user->username }}</p>
                                <p>Email: {{ $user->email }}</p>
                                <p>Hobbies: {{ $user->hobbies }}</p>
                                <p>Field of Work: {{ $user->field_of_work }}</p>
                                <p>Gender: {{ $user->gender }}</p>
                                <p>Mobile Number: {{ $user->mobile_number }}</p>
                                <p>Instagram: {{ $user->instagram_username }}</p>
                                <p>Date of Birth: {{ $user->date_of_birth }}</p>
                                <p>Wallet Balance: {{ $user->wallet_balance }} coins</p>
                                <p>Coins: {{ $user->coins }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
