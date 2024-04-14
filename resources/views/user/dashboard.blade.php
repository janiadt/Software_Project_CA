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
        <div>
            <div class="max-w-2xl mx-auto">
                <div class="max-w-3xl mx-3 mx-lg-auto sm:px-6 lg:px-8 space-y-6 bg-white mt-4 p-2 rounded">
                    <div class="p-6 text-gray-900 text-center">
                        <h1>{{ $main_chart->options['chart_title'] }}</h1>
                        {{-- My p5js canvas for the main chart. I'm using the ID to have it be referenced by the script below --}}
                        <div id="canvasMainChart" class="align-self-center"></div>
                    </div>
                </div>
            </div>
        </div>
    {{-- This is where we're rendering the less important charts --}}
        <div>
            <div class="max-w-2xl mx-auto">
                <div class="drop-shadow-3xl max-w-3xl mx-3 mx-lg-auto sm:px-6 lg:px-8 space-y-6 bg-gray-100 p-2  rounded">
                    <div class="p-6 text-gray-900 text-center">
                        <h1>Earning: 1c per hour</h1>
                        
                    </div>
                </div>
            </div>
            
        </div>
        
    @endsection

    @section('javascript')
        <script>
            // p5js canvas in the script tag
            function setup(){
                angleMode(DEGREES);
                let canvas = createCanvas(400,250);
                // Parenting the canvas to the canvasMainChart div
                canvas.parent('canvasMainChart');
                background(255);
                
            }
            function draw(){
                noLoop();
                push();
                // Drawing the arcs
                stroke(color("#73D99C"));
                strokeCap(SQUARE);
                strokeWeight(70);
                arc(width/2, height, 330, 280, 180, 0);
                stroke(color("#73D9D3"))
                arc(width/2, height, 330, 280, 180, -70);
                strokeWeight(25);
                stroke(color("#D97373"))
                arc(width/2, height, 200, 140, 180, 0);
                stroke(color("#D99173"))
                arc(width/2, height, 200, 140, 180, -20);
                pop();
                
               
            }

        </script>
    @endsection
    
</x-app-layout>



