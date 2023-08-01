@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Home</div>

                    <div class="card-body">
                        <!-- Show catalog of users with relevant photos based on their hobbies -->
                        <h4>Catalog of users with relevant photos based on their hobbies:</h4>
                        <!-- Gender Filter Container -->
                        <div class="mb-3">
                            <form action="{{ route('home.filter') }}" method="get">
                                <label for="gender">Filter by Gender:</label>
                                <select name="gender" id="gender" class="form-control">
                                    <option value="">All</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                <button type="submit" class="btn btn-primary mt-2">Apply Filter</button>
                            </form>
                        </div>

                        <!-- Hobby/Field of Work Filter Container -->
                        <div class="mb-3">
                            <form action="{{ route('home.filter') }}" method="get">
                                <label for="search">Search by Hobby/Field of Work:</label>
                                <input type="text" name="search" id="search" class="form-control" placeholder="Enter hobby or field of work">
                                <button type="submit" class="btn btn-primary mt-2">Search</button>
                            </form>
                        </div>

                        <div class="row">
                            @foreach ($users as $user)
                                <!-- Display users based on the selected gender filter and hobby/field of work search -->
                                @if ((!$genderFilter || $user->gender === $genderFilter) && (!$searchKeyword || stripos($user->hobbies_string, $searchKeyword) !== false || stripos($user->field_of_work, $searchKeyword) !== false))
                                    <div class="col-md-4 mb-4">
                                        <div class="card">
                                            <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="User Photo" class="card-img-top">
                                            <div class="card-body">
                                                <p class="card-text">{{ $user->full_name }}</p>
                                                <p class="card-text">Hobbies: {{ implode(', ', $user->hobbies->pluck('name')->toArray()) }}</p>
                                                <p class="card-text">Field of Work: {{ $user->field_of_work->name ?? '-' }}</p>
                                                @if (Auth::check() && !in_array($user->id, Auth::user()->wishlist ?? []))
                                                    <form action="{{ route('wishlist.add', $user) }}" method="post">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary">Add to Wishlist</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            @foreach ($users as $user)
                            @if ($user->visible)
                                <img src="{{ $user->avatar_url }}" alt="Profile Photo" class="img-thumbnail">
                            @else
                                <img src="{{ asset('path/to/bear/photos/' . $user->bear_photo) }}" alt="Bear Photo" class="img-thumbnail">
                            @endif
                            @endforeach
                            <form action="{{ route('settings.hide_from_home') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger">Menghilangkan dari Halaman Utama (50 koin)</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
