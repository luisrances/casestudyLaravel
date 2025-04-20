@extends('admin')

@section('title', 'Dashboard')

@section('content')
<div class="tab-pane fade {{ request()->is('admin/transactions*') ? 'show active' : '' }}" id="transactions">
    <h1>transactions content</h1>
    <p>Welcome to the transactions section.</p>
</div>
@endsection