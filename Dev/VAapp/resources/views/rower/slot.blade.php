<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-teal overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-ecru">
                    {{ __("List of available slots!") }}
                </div>
            </div>
        </div>
    </div>
    
    <!-- Table Header -->
    <table class="border-separate border-spacing-2 border-2 border-black bg-gradient-to-r from-photo_blue to-azure_web table-auto mx-auto">
        <thead>
            <tr>
                <th class="border-2 border-indigo-500 px-2 text-center">Date</th>
                <th class="border-2 border-indigo-500 px-2 text-center">Hour</th>
                <th class="border-2 border-indigo-500 px-2 text-center">Places left</th>
                <th class="border-2 border-indigo-500 px-2 text-center">Actions</th>
            </tr>
        </thead>
    <!-- Table Body -->
    <tbody id="tableSlots" >
            @foreach ($availableSlots as $slot)
                @php 
                    $slot_canoes = $slot->get_slot_canoes();
                @endphp
                <tr>
                    <td class="px-2 text-center">{{date_format(date_create($slot->date),'d-m-Y')}}</td>
                    <td class="px-2 text-center">{{date_format(date_create($slot->start_time),'H:i') . " - " . date_format(date_create($slot->end_time),'H:i')}}</td>
                    <td class="text-center">{{$slot->get_left_places()}}</td>
                    <td>
                        <button
                        class="group relative bg-hunyadi_yellow rounded-xl flex w-full items-center rounded-none border-0 px-5 py-4 text-left text-base text-neutral-800 transition [overflow-anchor:none] hover:z-[2] focus:z-[3] focus:outline-none dark:bg-neutral-800 dark:text-white [&:not([data-te-collapse-collapsed])]:bg-amber-600 [&:not([data-te-collapse-collapsed])]:text-black [&:not([data-te-collapse-collapsed])]:[box-shadow:inset_0_-1px_0_rgba(229,231,235)] dark:[&:not([data-te-collapse-collapsed])]:bg-neutral-800 dark:[&:not([data-te-collapse-collapsed])]:text-primary-400 dark:[&:not([data-te-collapse-collapsed])]:[box-shadow:inset_0_-1px_0_rgba(75,85,99)]"
                        type="button"
                        data-te-collapse-init
                        data-te-collapse-collapsed
                        data-te-target="#{{'accordion_'.$slot->id}}"
                        aria-expanded="false">
                        Reserve a place
                        </button>

                    </td>
                    
                </tr>
                <tr
                        id="{{'accordion_'.$slot->id}}"
                        class="!visible hidden border-0"
                        data-te-collapse-item
                        data-te-parent="tableSlots">
                        <td colspan="4" class="px-5 py-4 justify-center">
                            <form method="POST" action="{{ route('reserve_place') }}">
                                @csrf
                                <input type="hidden" name="slot_id" value="{{$slot->id}}"/>
                                @foreach ($slot_canoes as $slot_canoe)
                                    @php 
                                        $actual_places = $slot_canoe->get_places();
                                    @endphp
                                    <h3>{{$slot_canoe->get_canoe_name();}}</h3>
                                    <div class="p-2 my-4 justify-center flex flex-row flex-nowrap bg-hunyadi_yellow rounded-md border-black border-2 border-double">
                                        @foreach ($actual_places as $place) 
                                            <div class="p-2 mx-2 basis-1/6 rounded-full bg-fern_green border-black border-2 text-center">{{$place->position}}</div>
                                            @if ($place->rower_id != null) 
                                                <input type="radio" disabled checked class="relative float-bottom disabled:opacity-70 checked:bg-black">
                                            @else
                                                <input type="radio" name="choosenPlace" value="{{$place->id}}" class="relative float-bottom disabled:opacity-70">
                                            @endif
                                        @endforeach
                                    </div>
                                @endforeach
                                <button type="submit" class="inline-block rounded bg-azure_web px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-slate-400 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-slate-500">
                                    Confirm
                                </button>
                            </form>
                        </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-teal overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-ecru">
                    {{ __("List of reserved slots!") }}
                </div>
            </div>
        </div>
    </div>

    <!-- Table Header -->
    <table class="border-separate border-spacing-2 border-2 border-black bg-gradient-to-r from-photo_blue to-azure_web table-auto mx-auto">
        <thead>
            <tr>
                <th class="border-2 border-indigo-500 px-2 text-center">Date</th>
                <th class="border-2 border-indigo-500 px-2 text-center">Hour</th>
                <th class="border-2 border-indigo-500 px-2 text-center">Places left</th>
                <th class="border-2 border-indigo-500 px-2 text-center">Actions</th>
            </tr>
        </thead>
    <!-- Table Body -->
        <tbody>
            @foreach ($reservedSlots as $slot)
                @php 
                    $slot_canoes = $slot->get_slot_canoes();
                @endphp
                <tr>
                    <td class="px-2 text-center">{{date_format(date_create($slot->date),'d-m-Y')}}</td>
                    <td class="px-2 text-center">{{date_format(date_create($slot->start_time),'H:i') . " - " . date_format(date_create($slot->end_time),'H:i')}}</td>
                    <td class="text-center">{{$slot->get_left_places()}}</td>
                    <td>
                        <button
                        class="group relative bg-hunyadi_yellow rounded-xl flex w-full items-center rounded-none border-0 px-5 py-4 text-left text-base text-neutral-800 transition [overflow-anchor:none] hover:z-[2] focus:z-[3] focus:outline-none dark:bg-neutral-800 dark:text-white [&:not([data-te-collapse-collapsed])]:bg-amber-600 [&:not([data-te-collapse-collapsed])]:text-black [&:not([data-te-collapse-collapsed])]:[box-shadow:inset_0_-1px_0_rgba(229,231,235)] dark:[&:not([data-te-collapse-collapsed])]:bg-neutral-800 dark:[&:not([data-te-collapse-collapsed])]:text-primary-400 dark:[&:not([data-te-collapse-collapsed])]:[box-shadow:inset_0_-1px_0_rgba(75,85,99)]"
                        type="button"
                        data-te-collapse-init
                        data-te-collapse-collapsed
                        data-te-target="#{{'accordion_'.$slot->id}}"
                        aria-expanded="false">
                        See your reservation
                        </button>

                    </td>
                    
                </tr>
                <tr
                        id="{{'accordion_'.$slot->id}}"
                        class="!visible hidden border-0"
                        data-te-collapse-item
                        data-te-parent="tableSlots">
                        <td colspan="4" class="px-5 py-4 justify-center">
                            <form method="POST" action="{{ route('cancel_reserve') }}">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="slot_id" value="{{$slot->id}}"/>
                                @foreach ($slot_canoes as $slot_canoe)
                                    @php 
                                        $actual_places = $slot_canoe->get_places();
                                    @endphp
                                    <h3>{{$slot_canoe->get_canoe_name();}}</h3>
                                    <div class="p-2 my-4 justify-center flex flex-row flex-nowrap bg-hunyadi_yellow rounded-md border-black border-2 border-double">
                                        @foreach ($actual_places as $place) 
                                            <div class="p-2 mx-2 basis-1/6 rounded-full bg-fern_green border-2 border-black text-center">{{$place->position}}</div>
                                            @if ($place->rower_id != null)
                                                @if($place->rower_id == auth()->user()->id)
                                                <input type="radio" name="place" value="{{$place->id}}" checked class="relative float-bottom disabled:opacity-70 checked:bg-amber-500">
                                                @else
                                                <input type="radio" disabled checked class="relative float-bottom disabled:opacity-70 checked:bg-black">
                                                @endif
                                            @else
                                                <input type="radio" disabled class="relative float-bottom disabled:opacity-70">
                                            @endif
                                        @endforeach
                                    </div>
                                @endforeach
                                <button type="submit" class="inline-block rounded bg-azure_web px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-slate-400 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-slate-500">
                                    Cancel
                                </button>
                            </form>
                        </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>
