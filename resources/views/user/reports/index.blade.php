@extends('layouts.app')
@section('content')

    @auth
    <div class="max-w-3xl mx-3 mx-lg-auto sm:px-6 lg:px-8 space-y-6 bg-white mt-4 p-2 rounded">
        <h2 class="text-center">Error Reports</h2>
        <a href="{{route('errors.create')}}" class="btn btn-primary px-2">Create Error Report</a>


        {{-- Here I will display all of the error reports made by the user and their status --}}
        <table class="table table-bordered mt-3" id="normal-table" style="table-layout:auto">
            <thead class="table-primary">
            <tr>
                <th scope="col" style="width:45%" class="p-2 text-left">Report Title</th>
                <th scope="col" class="p-2">Created By</th>
                <th scope="col" class="p-2">Created At</th>
                <th scope="col" class="p-2">Severity</th>
            </tr>
            @forelse($reports as $report)
            </thead>
            <tbody>
                <tr>
                {{-- Link to show page --}}
                <td class="p-3"><a href="{{route('errors.show',$report->id)}}" id="counter" class="link-underline link-underline-opacity-0 link-underline-opacity-100-hover text-black">{{$report->title}}</a></td>
                {{-- User name --}}
                <td class="p-3">{{$report->users->name}}
                <td class="p-3">{{$report->created_at->diffForHumans()}}
                <td class="p-3">{{$report->severity}}
                </tr>
            </tbody>
            @empty
            <h4 class="text-center">No Reports Yet</h4>
            @endforelse
        </table>

        {{-- Pagination links --}}
        <div class="d-flex justify-content-center">
            {{ $reports->links() }}
        </div>
    </div>
    @endauth

@endsection