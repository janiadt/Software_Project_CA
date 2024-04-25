@extends('layouts.app')
@section('content')

    @auth
    <div class="max-w-3xl mx-3 mx-lg-auto sm:px-6 lg:px-8 space-y-6 bg-white mt-4 p-2 rounded">
        <h2 class="text-center">Registered Companies</h2>
        <a href="{{route('companies.create')}}" class="btn btn-primary px-2">Register Company</a>


        <table class="table table-bordered mt-3" id="normal-table" style="table-layout:auto">
            <thead class="table-primary">
            <tr>
                <th scope="col" style="width:45%" class="p-1 text-left">Company Name</th>
                <th scope="col" class="p-1">Address</th>
                <th scope="col" class="p-1">Registered at</th>
            </tr>
            @forelse($companies as $company)
            </thead>
            <tbody>
                <tr>
                {{-- Link to show page --}}
                <td class="p-2"><a href="{{route('companies.show',$company->id)}}" id="counter" class="link-underline link-underline-opacity-0 link-underline-opacity-100-hover text-black">{{$company->name}}</a></td>
                <td class="p-2">{{$company->address}}
                <td class="p-2">{{$company->created_at}}
                </tr>
            </tbody>
            @empty
            <h4 class="text-center">No Companies Registered</h4>
            @endforelse
        </table>

        {{-- Pagination links --}}
        <div class="d-flex justify-content-center">
            {{ $companies->links() }}
        </div>
    </div>
    @endauth

@endsection