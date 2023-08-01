@extends('layouts.master')

@section('title', 'Halaman Pembayaran')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                @if (Session::has('warning'))
                    <div class="alert alert-warning" role="alert">
                        {{ Session::get('warning') }}
                    </div>
                @endif

                @if (Session::has('info'))
                    <div class="alert alert-info" role="alert">
                        {{ Session::get('info') }}
                        <br>
                        <a href="{{ route('balance') }}" class="btn btn-primary">Ya</a>
                        <a href="{{ route('payment') }}" class="btn btn-secondary">Tidak</a>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        Halaman Pembayaran
                    </div>
                    <div class="card-body">
                        <form action="/process-payment" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="payment_amount">Jumlah Pembayaran</label>
                                <input type="number" name="payment_amount" id="payment_amount" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Bayar Sekarang</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
