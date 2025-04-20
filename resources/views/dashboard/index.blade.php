@extends('admin')

@section('title', 'Dashboard')

@section('content')
<div class="tab-pane fade {{ request()->is('admin/dashboard*') || request()->is('admin') ? 'show active' : '' }}" id="dashboard">
    <h1>Dashboard</h1>
    <p>Welcome to the Dashboard section.</p>
</div>
@endsection