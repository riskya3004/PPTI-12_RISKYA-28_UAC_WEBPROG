@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Send Avatar to Another User</div>

                    <div class="card-body">
                        <form action="{{ route('send.avatar.submit') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="avatar">Select Avatar:</label>
                                <input type="file" name="avatar" id="avatar" class="form-control-file @error('avatar') is-invalid @enderror" required>
                                @error('avatar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="receiver_id">Select Receiver:</label>
                                <select name="receiver_id" id="receiver_id" class="form-control @error('receiver_id') is-invalid @enderror" required>
                                    <option value="">Select Receiver</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('receiver_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Avatar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
