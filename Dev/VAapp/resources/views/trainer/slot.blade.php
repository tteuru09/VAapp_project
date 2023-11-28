<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-green-400 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("List of all slots!") }}
                </div>
            </div>
        </div>
    </div>
    
    <table class="border-separate border-spacing-2 border-2 border-slate-400 bg-white table-auto mx-auto">
        <thead>
            <tr class="">
                <th class="border-2 border-indigo-500 px-2 text-center">Date</th>
                <th class="border-2 border-indigo-500 px-2 text-center">Hour</th>
                <th class="border-2 border-indigo-500 px-2 text-center">Places left</th>
                <th class="border-2 border-indigo-500 px-2 text-center">List of canoes</th>
                <th class="border-2 border-indigo-500 px-2 text-center">List of rowers</th>
                <th class="border-2 border-indigo-500 px-2 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($slots as $slot)
            @php
                $total_place = 0;
                $slot_canoes = $slots_canoes->where('ref_slot', $slot->id);
                $slot_rowers = $slots_rowers->where('ref_slot', $slot->id);
                
                foreach ($slot_canoes as $slot_canoe){
                    $actual_canoe = $canoes->find($slot_canoe->ref_canoe);
                    $total_place += $actual_canoe->numberOfPlace;
                }
            @endphp  
            <tr class="odd:bg-white even:bg-slate-300">
                <td class="px-2 text-center">{{date_format(date_create($slot->date),'d-m-Y')}}</td>
                <td class="px-2 text-center">{{date_format(date_create($slot->start_time),'H:i') . " - " . date_format(date_create($slot->end_time),'H:i')}}</td>
                <td class="text-center">{{$total_place}}</td>
                <td class="text-center bg-white">
                    <button id="dropCanoes" data-dropdown-toggle="{{'ListCanoes_' . $slot->id}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                        List of canoes
                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                    <!-- List of canoes menu -->
                    <div id="{{'ListCanoes_' . $slot->id}}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropCanoes">
                        @foreach ($slot_canoes as $slot_canoe)
                            @php 
                                $canoe = $canoes->find($slot_canoe->ref_canoe);
                            @endphp
                            <li>
                                {{$canoe->name . " : " . $canoe->numberOfPlace}}
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </td>
                <td class="text-center bg-white">
                    <button id="dropRowers" data-dropdown-toggle="{{'ListRowers_' . $slot->id}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                        List of rowers 
                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                    <!-- List of rowers menu -->
                    <div id="{{'ListRowers_' . $slot->id}}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropRowers">
                        @foreach ($slot_rowers as $slot_rower)
                            @php 
                                $rower = $rowers->find($slot_rower->ref_rower);
                            @endphp
                            <li>
                                {{$rower->first_name . " " . $rower->last_name}}
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </td>
                <td class="bg-white">
                    <button class="p-2 bg-amber-300">Edit</button>
                    <button class="p-2 bg-red-600">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- <div class="flex justify-center mt-4">
        <a href="addSlot.trainer">
            <button class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                Add Slot
            </button>
        </a>
    </div> -->
    <div class="flex justify-center">
        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">New slot</h2>
                <form method="POST" action="{{ route('add_slot') }}">
                    @csrf
                    <div
                    class="relative mb-1"
                    id="dateID"
                    data-te-format="dd-mm-yyyy"
                    data-te-input-wrapper-init>
                        <input
                            type="text"
                            id="dateForm"
                            class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                            name="date" 
                            value="{{old('date')}}"/>
                        <label
                            for="dateForm"
                            class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary"
                            >Select a date</label>
                    </div>
                    @if ($errors->has('date'))
                        @foreach ($errors->get('date') as $message) 
                            <p class="text-red-600 text-xs"> {{$message}} </p> 
                        @endforeach
                    @endif
                    <div
                        class="relative mt-2 mb-1"
                        data-te-format24="true"
                        id="timeStart"
                        data-te-input-wrapper-init>
                        <input
                            type="text"
                            class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                            data-te-toggle="timepicker"
                            id="formStart"
                            name="timeStart"
                            value="{{old('timeStart')}}" />
                        <label
                            for="formStart"
                            class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary"
                            >Select a time</label
                        >
                    </div>
                    @if ($errors->has('timeStart'))
                        @foreach ($errors->get('timeStart') as $message) 
                            <p class="text-red-600 text-xs"> {{$message}} </p> 
                        @endforeach
                    @endif
                    <div
                        class="relative mt-2 mb-1"
                        data-te-format24="true"
                        id="timeEnd"
                        data-te-input-wrapper-init>
                        <input
                            type="text"
                            class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                            data-te-toggle="timepicker"
                            id="formEnd"
                            name="timeEnd"
                            value="{{old('timeEnd')}}" />
                        <label
                            for="formEnd"
                            class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary"
                            >Select a time</label
                        >
                    </div>
                    @if ($errors->has('timeEnd'))
                        @foreach ($errors->get('timeEnd') as $message) 
                            <p class="text-red-600 text-xs"> {{$message}} </p> 
                        @endforeach
                    @endif
                    <div class="relative mt-2 mb-1">
                        <select data-te-select-init multiple value="" name="canoes[]" label="vide">
                            @foreach ($canoes as $canoe)
                            <option value="{{$canoe->id}}">{{ $canoe->name . " : " . $canoe->numberOfPlace}}</option>
                            @endforeach
                        </select>
                        <label data-te-select-label-ref>Select canoes</label>
                    </div>
                    <div class="relative mt-2 mb-1">
                        <select data-te-select-init multiple value="" name="rowers[]">
                            @foreach ($rowers as $rower)
                            <option value="{{$rower->id}}">{{ $rower->first_name . " " . $rower->last_name}}</option>
                            @endforeach
                        </select>
                        <label data-te-select-label-ref>Select users</label>
                    </div>
                    <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-gray-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                        Add Slot
                    </button>
                </form>
            </div>
        </section>
    </div>
    
</x-app-layout>
