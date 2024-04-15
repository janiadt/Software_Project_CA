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
                        <h1>System Production Chart</h1>
                        {{-- My p5js canvas for the main chart. I'm using the ID to have it be referenced by the script below --}}
                        <div id="canvasMainChart" class="d-flex justify-content-center"></div>
                    </div>
                </div>
            </div>
        </div>
    {{-- This is where we're rendering the less important charts --}}
        <div>
            <div class="max-w-2xl mx-auto">
                <div class="drop-shadow-3xl max-w-3xl mx-3 mx-lg-auto sm:px-6 lg:px-8 space-y-6 bg-gray-100 p-2  rounded">
                    <div class="p-6 pt-1 text-gray-900 text-center">
                        <h4>Earning: <small class="text-metal">{{$data[0]["Export"]}}c per hour</small></h4>
                        <p>Expected Export vs Average</p>
                    </div>
                </div>
            </div>
            
        </div>
       
    @endsection

    @section('javascript')
        <script>
            // p5js canvas in the script tag
            let data;
            function setup(){
                angleMode(DEGREES);
                let canvas = createCanvas(400,250);
                // Passing the $data array to our javascript
                data = {!! json_encode($data) !!};
                // Parenting the canvas to the canvasMainChart div
                canvas.parent('canvasMainChart');
                background(255);

                
            }
            function draw(){
                noLoop();
                push();
                let selfcData = data[0].SelfConsumption;
                let syscData = data[0].SystemProduction;

                // Drawing the arcs

                // Displaying the text used to describe the main pie chart
                textSize(15)
                // system production
                text("System Production: ", 250, 40);
                push();
                fill(color("#73D99C"));
                text(syscData + "kWh", 295, 60);
                pop();
                // consumption
                text("Self Consumption: ", 10, 40);
                push();
                fill(color("#73D9D3"));
                text(selfcData + "kWh", 50, 60);
                pop();

                // Mapping the selfConsumption data point from 0 to the max, to 0 - 180
                let fixedData = map(selfcData, 0, syscData, 0, 180);
                let averageConsumption = 6;
                let fixedConsData = map(selfcData, 0, averageConsumption, 0, 180);
                stroke(color("#73D99C"));
                strokeCap(SQUARE);
                strokeWeight(70);
                arc(width/2, height, 330, 280, 180, 0);
                // Self consumption
                stroke(color("#73D9D3"))
                // translating to the correct location then rotating by 180
                push();
                translate(width/2, height);
                rotate(180)
                arc(0,0, 330, 280, 0, fixedData);
                pop();
                strokeWeight(25);
                
                stroke(color("#D97373"))
                arc(width/2, height, 200, 140, 180, 0);

                // consumption based on average in country
                push()
                translate(width/2, height);
                rotate(180)
                stroke(color("#D99173"))
                arc(0, 0, 200, 140, 0, fixedConsData);
                pop();
                
                pop();      

                // consumption based on average 
                text("Consumption: ", 165, 235);
                push();
                fill(color("#D99173"));
                text(selfcData + "kWh", 180, 250);
                pop();
            }

        </script>
    @endsection
    
</x-app-layout>



