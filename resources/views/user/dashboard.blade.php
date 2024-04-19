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

    <label for="days" class="pt-4 mx-2">Choose a day:</label>

    <select name="days" id="day">

        @foreach(array_keys($data) as $d)
        <option value={{$d}} >{{$d + 1}}</option>
        @endforeach
    </select>

    {{-- This is where we're rendering my daily usage pie chart --}}
        <div>
            <div class="max-w-2xl mx-auto">
                <div class="max-w-3xl mx-3 mx-lg-auto sm:px-6 lg:px-8 space-y-6 bg-white p-2 rounded">
                    <div class="p-6 text-gray-900 text-center">
                        <h1>System Production Chart</h1>
                        {{-- My p5js canvas for the main chart. I'm using the ID to have it be referenced by the script below --}}
                        <div id="canvasMainChart1" class="d-flex justify-content-center"></div>
                    </div>
                </div>
            </div>
        </div>
    {{-- This is where we're rendering the less important charts --}}
        <div>
            <div class="max-w-2xl mx-auto">
                <div class="drop-shadow-3xl max-w-3xl mx-3 mx-lg-auto sm:px-6 lg:px-8 space-y-6 bg-gray-100 p-2  rounded">
                    <div class="p-6 pt-1 text-gray-900 text-center">
                        <h4>Earning: <small class="text-metal">{{$data[1]["Export"]}}c per hour</small></h4>
                        <p>Expected Export vs Average</p>
                        <div id="canvasMainChart2" class="d-flex justify-content-center"></div>
                    </div>
                </div>
            </div>
        </div>

    {{-- If the user is a free user, display the subscribe message --}}

    @if (Auth::user()->user_type === "Free User" || !Auth::user()->user_type === "Subscriber" && Auth::user()->user_type !== "Developer")
    <div class="max-w-2xl mx-auto">
        <div class="text-center drop-shadow-3xl max-w-3xl mx-3 mx-lg-auto sm:px-6 lg:px-8 space-y-6 bg-gray-100 p-5 mt-5  rounded">
            <h4>Subscribe now and become a paying user!</h4>
            <p>Remove advertisements and gain access to more detailed data breakdowns! </p>
            <div class="text-gray-900 text-center">
                <form method="GET" action="{{ route('profile.subscribe') }}">
                <x-primary-button>Subscribe</x-primary-button>
                </form>
            </div>
        </div>
    </div>
    @endif
       
    @endsection

    @section('javascript')
        <script>       
            // Using p5js in instance mode, so I can call multiple canvases
            let daySelect = document.getElementById("day");
            
            console.log(daySelect);

            var sketch1 = function(p) {
                p.setup = function() {
                    const firstCanvas = p.createCanvas(400, 250);
                    p.angleMode(p.DEGREES);
                    // Passing the $data array to our javascript
                    data = {!! json_encode($data) !!};
                    // Parenting the canvas to the canvasMainChart div
                    firstCanvas.parent('canvasMainChart1');
                    p.background(255);
                }

                p.draw = function() {
                    p.background(255);
                    p.push();
                   
                    let selfcData = data[daySelect.value].SelfConsumption;
                    let syscData = data[daySelect.value].SystemProduction;

                    // Drawing the arcs

                    // Displaying the text used to describe the main pie chart
                    p.textSize(15)
                    // system production
                    p.text("System Production: ", 250, 40);
                    p.push();
                    p.fill(p.color("#73D99C"));
                    p.text(syscData + "kWh", 295, 60);
                    p.pop();
                    // consumption
                    p.text("Home Consumption: ", 10, 40);
                    p.push();
                    p.fill(p.color("#73D9D3"));
                    p.text(selfcData + "kWh", 50, 60);
                    p.pop();

                    // Mapping the selfConsumption data point from 0 to the max, to 0 - 180
                    let fixedData = p.map(selfcData, 0, syscData, 0, 180);
                    let averageConsumption = 6;
                    let fixedConsData = p.map(selfcData, 0, averageConsumption, 0, 180);
                    p.stroke(p.color("#73D99C"));
                    p.strokeCap(p.SQUARE);
                    p.strokeWeight(70);
                    p.arc(p.width/2, p.height, 330, 280, 180, 0);
                    // Self consumption
                    p.stroke(p.color("#73D9D3"))
                    // translating to the correct location then rotating by 180
                    p.push();
                    p.translate(p.width/2, p.height);
                    p.rotate(180)
                    p.arc(0,0, 330, 280, 0, fixedData);
                    p.pop();
                    p.strokeWeight(25);
                    
                    p.stroke(p.color("#D97373"))
                    p.arc(p.width/2, p.height, 200, 140, 180, 0);

                    // consumption based on average in country
                    p.push()
                    p.translate(p.width/2, p.height);
                    p.rotate(180)
                    p.stroke(p.color("#D99173"))
                    p.arc(0, 0, 200, 140, 0, fixedConsData);
                    p.pop();
                    
                    p.pop();      

                    // consumption based on average 
                    p.text("Consumption vs Average: ", 130, 235);
                    p.push();
                    p.fill(p.color("#D99173"));
                    p.text(selfcData + "kWh", 180, 250);
                    p.pop();
                }
            }

            var sketch2 = function(p) {
                p.setup = function() {
                    const canvas = p.createCanvas(400, 50);
                    p.angleMode(p.DEGREES);
                    // Passing the $data array to our javascript
                    data = {!! json_encode($data) !!};
                    // Parenting the canvas to the canvasMainChart div
                    canvas.parent('canvasMainChart2');
                    p.background(255);
                }

                p.draw = function() {
                    p.background(255);
                    p.push();
                    let exportData = data[daySelect.value].Export;

                    let averageExport = 5;
                    let fixedData = p.map(exportData, 0, averageExport, 0, p.width);
                    

                    p.fill(p.color("#D97373"))
                    p.rect(0,0,400,50);

                    p.fill(p.color("#73D9D3"))
                    p.rect(0,0,fixedData,50);
                    
                }
            }

            // Making a new p5 sketch for both of my graphs. If I had more time, I could make an array of these and 
            // let the user create their own
            var my1 = new p5(sketch1);
            var my2 = new p5(sketch2);

        </script>
    @endsection
    
</x-app-layout>



