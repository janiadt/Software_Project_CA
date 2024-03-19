<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    @section('content')
    {{-- This is where we're rendering my daily usage pie chart --}}
        <div class="py-10">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h1>{{ $main_chart->options['chart_title'] }}</h1>
                        {!! $main_chart->renderHtml() !!}
                    </div>
                </div>
            </div>
        </div>
    {{-- This is where we're rendering the less important charts --}}
        <div class="py-10">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h1>{{ $main_chart->options['chart_title'] }}</h1>
                        {!! $main_chart->renderHtml() !!}
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('javascript')
    {!! $main_chart->renderChartJsLibrary() !!}
    {!! $main_chart->renderJs() !!}
    @endsection
    
</x-app-layout>



