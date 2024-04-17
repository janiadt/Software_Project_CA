@extends('layouts.app')
@section('content')

{{-- Jumbotron when a guest first comes to the site --}}
@guest
<div>
    <div class="max-w-2xl mx-auto">
        <div class="text-center drop-shadow-3xl max-w-3xl mx-3 mx-lg-auto sm:px-6 lg:px-8 space-y-6 bg-gray-100 p-5 mt-5  rounded">
            <h4>Welcome to Solarray!</h4>
            <p>Register to upload and display your solar panel data</p>
            <div class="text-gray-900 text-center">
                <form method="GET" action="{{ route('register') }}">
                <x-primary-button>Register</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</div>
@endguest
@auth
<div class="max-w-2xl mx-auto">
    <div class="text-center drop-shadow-3xl max-w-3xl mx-3 mx-lg-auto sm:px-6 lg:px-8 space-y-6 bg-gray-100 p-5 mt-5  rounded">
        <h4>Welcome to Solarray!</h4>
        <p>View your solar panels by expanding the navigation menu! </p>
        <p>View your dashboard here! </p>
        <div class="text-gray-900 text-center">
            <form method="GET" action="{{ route('dashboard') }}">
            <x-primary-button>Dashboard</x-primary-button>
            </form>
        </div>
    </div>
</div>
@endauth
@endsection