@extends('backend.layouts.app')
@section('title','Edit User')
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>
                Edit User
            </div>
        </div>
    </div>
</div>



<div class="content">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.user.update', $user->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="{{ $user->name }}"
                        class=" form-control @error('name') border border-danger @enderror">
                    @error('name')
                    <div class="text-danger mt-2 text-sm">
                        <i class="fas fa-exclamation-circle text-danger"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}"
                        class="form-control @error('email') border border-danger @enderror">
                    @error('email')
                    <div class="text-danger mt-2 text-sm">
                        <i class="fas fa-exclamation-circle text-danger"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="number" name="phone" value="{{ $user->phone }}"
                        class="form-control @error('phone') border border-danger @enderror">
                    @error('phone')
                    <div class="text-danger mt-2 text-sm">
                        <i class="fas fa-exclamation-circle text-danger"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password"
                        class="form-control @error('password') border border-danger @enderror">
                    @error('password')
                    <div class="text-danger mt-2 text-sm">
                        <i class="fas fa-exclamation-circle text-danger"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="d-flex">
                    <button type="submit" class="btn btn-primary mr-3">Update</button>
                    <button class="btn btn-secondary back-btn">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection