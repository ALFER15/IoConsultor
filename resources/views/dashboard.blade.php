<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12"> 1
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="doctor-container flex justify-center mb-4" style="background-image: url('https://media.istockphoto.com/id/1251458149/vector/heartbeat-health-care-and-science-icon-medical-innovation-concept-background-vector-design.jpg?s=612x612&w=0&k=20&c=it0JEzqixpT5wNZEdkf9yn_8idMMUSrkcL_x3v3oWdY=')"> <div class="doctor-wrapper relative">
                        <img src="https://i.pinimg.com/originals/16/96/71/169671343ef815d20808e6c9e43c5c19.png" alt="Doctor" class="doctor-image object-contain"> </div>
                    </div>
                @livewire('table-admin')
            </div>
        </div>
    </div>
</x-app-layout>

<style>
  /* New styles for doctor section */
  .doctor-container {
    margin-bottom: 2rem; /* Add some space below the doctor section */
  }
  .doctor-wrapper {
    width: 200px; /* Adjust width as needed */
    height: 300px; /* Adjust height as needed */
  }
  .doctor-background {
    width: 100%;
    height: 100%;
  }
  .doctor-image {
    width: 200px;
    height: 300px;
    position: absolute; /* Position image on top of background */
    top: 64%; /* Center image vertically */
    left: 50%; /* Center image horizontally */
    transform: translate(-50%, -50%); /* Adjust positioning for centering */
  }
</style>
