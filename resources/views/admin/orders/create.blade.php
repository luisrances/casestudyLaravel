@extends('admin.admin')

@section('content')
<div class="container container-fluid main" style="max-height: 100%;">
    <h1 class="text-right mb-2 px-1 mt-md-4">Add Order</h1>
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        @include('admin.orders.form')
            
        <div class="d-flex justify-content-center mt-3 column-gap-3">
            <button class="btn btn-success" style="width: 200px">Save</button>
            <a href="{{ url()->previous() }}" class="btn bg-danger text-white me-2" style="width: 200px">Cancel</a>
        </div>
    </form>
</div>

<style>
    @media (max-width: 767px) {
        .main{
            min-height: 20vh !important;
            max-height: calc(100vh - 100px) !important;
            margin: 0px !important;
            overflow: hidden;
            justify-content: center; 
            align-items: center;
            overflow-y: hidden; 
        }
    }
</style>
@endsection
