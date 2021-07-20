@extends('backend.layouts.app')
@section('title','Create User')
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>
                Create User
            </div>
        </div>
    </div>
</div>



<div class="content">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.user.store') }}" method="post">
                @csrf
                @error('fail')
                    <div class="text-danger mt-2 text-sm">
                        <i class="fas fa-exclamation-circle text-danger"></i> {{ $message }}
                    </div>
                @enderror
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class=" form-control @error('name') border border-danger @enderror">
                    @error('name')
                    <div class="text-danger mt-2 text-sm">
                        <i class="fas fa-exclamation-circle text-danger"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="form-control @error('email') border border-danger @enderror">
                    @error('email')
                    <div class="text-danger mt-2 text-sm">
                        <i class="fas fa-exclamation-circle text-danger"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="number" name="phone" value="{{ old('phone') }}"
                        class="form-control @error('phone') border border-danger @enderror">
                    @error('phone')
                    <div class="text-danger mt-2 text-sm">
                        <i class="fas fa-exclamation-circle text-danger"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" value="{{ old('password') }}"
                        class="form-control @error('password') border border-danger @enderror">
                    @error('password')
                    <div class="text-danger mt-2 text-sm">
                        <i class="fas fa-exclamation-circle text-danger"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="d-flex">
                    <button type="submit" class="btn btn-primary mr-3">Create</button>
                    <button class="btn btn-secondary back-btn">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection