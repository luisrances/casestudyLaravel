@extends('admin.admin')

@section('title', 'Dashboard')

@section('content')
<div class="tab-pane fade {{ request()->is('admin/settings*') ? 'show active' : '' }}" id="settings">
    <h1>Account Settings</h1>
    <p>Welcome to the account section.</p>
</div>
@endsection