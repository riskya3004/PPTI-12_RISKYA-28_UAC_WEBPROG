@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Chat</div>

                    <div class="card-body">
                        <div class="chat-box">
                            @foreach ($chats as $chat)
                                <div class="message">
                                    <strong>{{ $chat->sender->name }}</strong>:
                                    {{ $chat->message }}
                                </div>
                            @endforeach
                        </div>

                        <form action="{{ route('chat.send') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="receiver_id">Receiver ID:</label>
                                <input type="text" name="receiver_id" id="receiver_id" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="message">Message:</label>
                                <textarea name="message" id="message" class="form-control" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
