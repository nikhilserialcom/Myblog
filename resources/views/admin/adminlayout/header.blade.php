<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}"> --}}
    <title>MyBlog</title>
    <link rel="shortcut icon" href="{{ asset('image/blogicon.png') }}" type="image/png">
    {{-- icon css --}}
    <link rel="stylesheet" href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css') }}">
     <link rel="stylesheet" href="{{ asset('https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css') }}">
    {{-- App css --}}
    <link href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css') }}" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    
    <div class="sidebar">
        <div class="logo-details">
          <a href="{{ route('admin.login') }}" class="logo_name">My Blog</a>
          <i class="bx bx-menu" id="btn"></i>
        </div>
        <ul class="nav-list">
          <li>
            <a href="{{ route('dashboard') }}">
              <i class="bx bx-grid-alt"></i>
              <span class="links_name">Dashboard</span>
            </a>
            <span class="tooltip">Dashboard</span>
          </li>
          <li>
            <a href="{{ route('admin.category') }}">
              <i class='bx bx-category-alt'></i>
              <span class="links_name">Category</span>
            </a>
            <span class="tooltip">Category</span>
          </li>
          <li>
            <a href="{{ route('admin.post') }}">
              <i class='bx bxs-plus-square'></i>
              <span class="links_name">Post</span>
            </a>
            <span class="tooltip">Post</span>
          </li>
          {{-- <li>
            <a href="{{ route('admin.register') }}">
              <i class='bx bxs-user'></i>
              <span class="links_name">Register</span>
            </a>
            <span class="tooltip">Register</span>
          </li> --}}
          <li>
              <a href="{{ route('profile.edit') }}">
                <i class="bx bx-cog"></i>
                <span class="links_name">Setting</span>
              </a>
              <span class="tooltip">Setting</span>
          </li>    
        </ul>
       
          <li class="profile">
            <div class="profile-details">
                    <img src="{{ asset(Auth::user()->profile) }}" alt="profileImg" />
                    <div class="name_job">
                        <div class="name">{{ Auth::user()->name }}</div>
                    </div>
            </div>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" style="background: none; border: none;">
                        <i class="bx bx-log-out" id="log_out"></i>
                    </button>
                </form>
       
      </div>
  