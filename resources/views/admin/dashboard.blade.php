@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Dashboard Admin</h1>

<div class="card shadow mb-4">
    <div class="card-body">
        <p>Selamat datang, {{ Auth::user()->name }}! Anda berada di dashboard admin.</p>
    </div>
</div>
@endsection