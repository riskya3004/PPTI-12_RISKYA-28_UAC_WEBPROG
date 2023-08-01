@extends('layouts.master')

@section('title', 'Register')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        Register
                    </div>
                    <div class="card-body">
                        <form action="/register" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="full_name">Nama lengkap</label>
                                <input type="text" name="full_name" id="full_name" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="hobbies">Hobbies (minimal 3 hobi, pisahkan dengan koma)</label>
                                <input type="text" name="hobbies" id="hobbies" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="birthdate">Tanggal Lahir</label>
                                <input type="date" name="birthdate" id="birthdate" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender" class="form-control" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="mobile_number">Mobile Number (must be all digits)</label>
                                <input type="tel" pattern="[0-9]+" name="mobile_number" id="mobile_number" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="instagram_username">Instagram username (in the form of a link http://www.instagram.com/username)</label>
                                <input type="url" name="instagram_username" id="instagram_username" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="profile_photo">Upload foto / capture from camera</label>
                                <input type="file" name="profile_photo" id="profile_photo" class="form-control-file" accept="image/*" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="registration_price">Registration Price</label>
                                <input type="text" name="registration_price" id="registration_price" class="form-control" value="{{ rand(100000, 125000) }}" readonly>
                            </div>

                            <button type="submit" class="btn btn-primary">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
