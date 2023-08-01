@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Collectors Angels (Show Off)</div>

                    <div class="card-body">
                        <h5>All Avatar Submissions:</h5>
                        @if($avatarSubmissions->count() > 0)
                            <ul>
                                @foreach($avatarSubmissions as $submission)
                                    <li>
                                        <strong>{{ $submission->sender->name }}</strong> sent an avatar to <strong>{{ $submission->receiver->name }}</strong>:
                                        <img src="{{ asset('storage/' . $submission->avatar_path) }}" alt="Submitted Avatar" class="img-thumbnail">
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>No avatar submissions found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
