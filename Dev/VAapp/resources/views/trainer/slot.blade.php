<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-teal overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-ecru">
                    {{ __("List of all slots!") }}
                </div>
            </div>
        </div>
    </div>
<!-- Table Header -->
    <table class="border-separate border-spacing-2 border-2 border-black rounded-xl bg-gradient-to-r from-photo_blue to-azure_web table-auto mx-auto">
        <thead>
            <tr class="">
                <th class="border-2 border-teal rounded-xl px-2 text-center">Date</th>
                <th class="border-2 border-teal rounded-xl px-2 text-center">Hour</th>
                <th class="border-2 border-teal rounded-xl px-2 text-center">Places left</th>
                <th class="border-2 border-teal rounded-xl px-2 text-center">List of rowers</th>
                <th class="border-2 border-teal rounded-xl px-2 text-center">Actions</th>
            </tr>
        </thead>
<!-- Table Body -->
        <tbody>
            @foreach ($slots as $slot)
            @php
                $slot_canoes = $slot->get_slot_canoes();
                $slot_rowers = $slot->get_slot_rowers();
                $edit_params = [
                "slot" => $slot,
                "canoes" => $slot_canoes,
                "rowers" => $slot_rowers
                ];
            @endphp  
            <tr class="">
                <td class="px-2 text-center">{{date_format(date_create($slot->date),'d-m-Y')}}</td>
                <td class="px-2 text-center">{{date_format(date_create($slot->start_time),'H:i') . " - " . date_format(date_create($slot->end_time),'H:i')}}</td>
                <td class="text-center">{{$slot->get_left_places()}}</td>
                <td class="text-center ">
                    <button id="dropRowers" data-dropdown-toggle="{{'ListRowers_' . $slot->id}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" >
                        List of rowers 
                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                    <!-- List of rowers menu -->
                    <div id="{{'ListRowers_' . $slot->id}}" class="z-10 hidden  divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200 bg-white" aria-labelledby="dropRowers">
                        @foreach ($slot_rowers as $slot_rower)
                            @php 
                                $rower = $rowers->find($slot_rower->ref_rower);
                            @endphp
                            <li>
                                @if ($slot_rower->reserved == 1)
                                    <span>&#10003;</span>
                                @endif
                                {{$rower->first_name . " " . $rower->last_name}}
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </td>
                <td class="">
                    <button
                    class="m-2 p-2 bg-caribbean_current text-white rounded-xl"
                    type="button"
                    data-te-collapse-init
                    data-te-collapse-collapsed
                    data-te-target="#{{'accordion_'.$slot->id}}"
                    aria-expanded="false">
                    Details
                    </button>
                </td>
            </tr>
            <tr
                id="{{'accordion_'.$slot->id}}"
                class="!visible hidden border-0"
                data-te-collapse-item
                data-te-parent="tableSlots">
                <td colspan="5" class="px-5 py-4 justify-center">
                    @foreach ($slot_canoes as $slot_canoe)
                        @php 
                            $actual_places = $slot_canoe->get_places();
                        @endphp
                        <h3><b>{{$slot_canoe->get_canoe_name();}}</b></h3>
                        <div class="p-2 my-4 justify-center flex flex-row flex-nowrap bg-hunyadi_yellow rounded-md border-black border-2">
                            @foreach ($actual_places as $place)
                                @php 
                                    $actual_rower = $place->get_rower();
                                @endphp 
                                @if ($actual_rower != null) 
                                    <div class="p-2 mx-2 basis-1/6 rounded-full bg-steel_blue text-center border-2 border-black"
                                        data-te-toggle="tooltip"
                                        data-te-placement="top"
                                        title="{{$actual_rower->first_name . ' ' . $actual_rower->last_name}}">{{substr($actual_rower->first_name,0,1) . '.' . substr($actual_rower->last_name,0,1)}}
                                    </div>
                                @else
                                    <div class="p-2 mx-2 basis-1/6 rounded-full bg-fern_green text-center border-2 border-black text-white">
                                        {{$place->position}}
                                    </div>                                            
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                    <p><b>Actions </b></p>
                    <button 
                        class="p-2 bg-hunyadi_yellow rounded-xl"
                        data-te-toggle="modal"
                        data-te-target="#modalEditSlot"
                        data-te-whatever="{{json_encode($edit_params)}}"
                        data-te-ripple-init
                        data-te-ripple-color="light"
                        >
                        Edit
                    </button>
                    <x-danger-button
                    data-te-toggle="modal"
                    data-te-target="#modalDeleteSlot"
                    data-te-whatever="{{$slot->id}}"
                    data-te-ripple-init
                    data-te-ripple-color="light">
                    Delete
                    </x-danger-button>
                </td>
            </tr>
            @php 
                $slot_canoes = array();
                $slot_rowers = array();
            @endphp
            @endforeach
        </tbody>
    </table>

    <button class="flex py-4 mx-auto"
            data-te-toggle="modal"
            data-te-target="#modalNewSlot"
            data-te-ripple-init>
        <svg width="50px" height="50px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path opacity="0.5" d="M2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C22 4.92893 22 7.28595 22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12Z" stroke="#1C274C" stroke-width="1.5"/>
            <path d="M15 12L12 12M12 12L9 12M12 12L12 9M12 12L12 15" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
        </svg>
    </button>

<!-- New Slot -->
    <div 
    data-te-modal-init
    class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
    id="modalNewSlot"
    tabindex="-2"
    aria-labelledby="modalEditLabel"
    aria-hidden="true">
    <div
            data-te-modal-dialog-ref
            class="pointer-events-none relative h-[calc(100%-1rem)] w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:h-[calc(100%-3.5rem)] min-[576px]:max-w-[500px]">
            <div
            class="pointer-events-auto relative flex max-h-[100%] w-full flex-col overflow-hidden rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-neutral-600">
            
                <div
                    class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                    <!--Modal title-->
                    <h5
                    class="text-xl font-medium leading-normal text-neutral-800 dark:text-neutral-200"
                    id="modalEditLabel">
                    Creating a new slot
                    </h5>
                    <!--Close button-->
                    <button
                    type="button"
                    class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
                    data-te-modal-dismiss
                    aria-label="Close">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="h-6 w-6">
                        <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    </button>
                </div>

                <!--Modal body-->
                <div id="ModalEditBody" class="relative overflow-y-auto p-2">
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
                </div>
            </div>
        </div>
    </div>

<!--Modal Delete -->
    <div
    data-te-modal-init
    class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
    id="modalDeleteSlot"
    tabindex="-1"
    aria-labelledby="modalDeleteTitle"
    aria-modal="true"
    role="dialog">
    <div
    data-te-modal-dialog-ref
    class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[500px]">
    <div
        class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-neutral-600">
            <div
            class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
            <!--Modal title-->
                <h5
                class="text-xl font-medium leading-normal text-neutral-800 dark:text-neutral-200"
                id="modalDeleteTitle">
                Are you sure you want to delete ?
                </h5>
                <!--Close button-->
                <button
                class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
                data-te-modal-dismiss
                aria-label="Close">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="h-6 w-6">
                    <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M6 18L18 6M6 6l12 12" />
                </svg>
                </button>
            </div>

            <!--Modal body-->
            <!--Modal footer-->
            <div
            id="ModalFooter"
            class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                <form method="post" action="{{ route('slot.destroy') }}" class="p-6">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="slot_id" value="">
                    <x-danger-button
                    data-te-ripple-init
                    data-te-ripple-color="light">
                    YES
                    </x-danger-button>
                    <button
                    class="ml-1 inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
                    data-te-modal-dismiss
                    data-te-ripple-init
                    data-te-ripple-color="light">
                    NO
                    </button>
                </form>
            </div>
        </div>
        </div>
    </div>



<!-- Modal Edit -->
    <div
    data-te-modal-init
    class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
    id="modalEditSlot"
    tabindex="-1"
    aria-labelledby="modalEditLabel"
    aria-hidden="true">
        <div
            data-te-modal-dialog-ref
            class="pointer-events-none relative h-[calc(100%-1rem)] w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:h-[calc(100%-3.5rem)] min-[576px]:max-w-[500px]">
            <div
            class="pointer-events-auto relative flex max-h-[100%] w-full flex-col overflow-hidden rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-neutral-600">
            
                <div
                    class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                    <!--Modal title-->
                    <h5
                    class="text-xl font-medium leading-normal text-neutral-800 dark:text-neutral-200"
                    id="modalEditLabel">
                    Making changes
                    </h5>
                    <!--Close button-->
                    <button
                    type="button"
                    class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
                    data-te-modal-dismiss
                    aria-label="Close">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="h-6 w-6">
                        <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    </button>
                </div>

                <!--Modal body-->
                <div id="ModalEditBody" class="relative overflow-y-auto p-2">
                    <div class="py-8 px-4 mx-auto max-w-2xl">
                        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edition of slot</h2>
                        <form method="POST" action="{{ route('edit_slot') }}">
                            @csrf
                            @method('put')
                            <input type="hidden" name="slot_id" value=""/>
                            <div
                            class="relative mb-1"
                            id="editDateID"
                            data-te-format="dd-mm-yyyy"
                            data-te-input-wrapper-init>
                                <input
                                    type="text"
                                    id="dateFormEdit"
                                    class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                    name="dateEdit" 
                                    value="{{old('dateEdit')}}"/>
                                <label
                                    for="dateFormEdit"
                                    class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary"
                                    >Select a date</label>
                            </div>
                            @if ($errors->has('dateEdit'))
                                @foreach ($errors->get('dateEdit') as $message) 
                                    <p class="text-red-600 text-xs"> {{$message}} </p> 
                                @endforeach
                            @endif
                            <div
                                class="relative mt-2 mb-1"
                                data-te-format24="true"
                                id="timeStartEdit"
                                data-te-input-wrapper-init>
                                <input
                                    type="text"
                                    class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                    data-te-toggle="timepicker"
                                    id="formStartEdit"
                                    name="timeStartEdit"
                                    value="{{old('timeStartEdit')}}" />
                                <label
                                    for="formStartEdit"
                                    class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary"
                                    >Select a time</label
                                >
                            </div>
                            @if ($errors->has('timeStartEdit'))
                                @foreach ($errors->get('timeStartEdit') as $message) 
                                    <p class="text-red-600 text-xs"> {{$message}} </p> 
                                @endforeach
                            @endif
                            <div
                                class="relative mt-2 mb-1"
                                data-te-format24="true"
                                id="timeEndEdit"
                                data-te-input-wrapper-init>
                                <input
                                    type="text"
                                    class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                    data-te-toggle="timepicker"
                                    id="formEndEdit"
                                    name="timeEndEdit"
                                    value="{{old('timeEndEdit')}}" />
                                <label
                                    for="formEndEdit"
                                    class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary"
                                    >Select a time</label
                                >
                            </div>
                            @if ($errors->has('timeEndEdit'))
                                @foreach ($errors->get('timeEndEdit') as $message) 
                                    <p class="text-red-600 text-xs"> {{$message}} </p> 
                                @endforeach
                            @endif
                            <p>List of canoes</p>
                            <div class="relative mt-2 mb-1">
                                <select data-te-select-init multiple value="" name="canoes[]" label="vide">
                                    @foreach ($canoes as $canoe)
                                    <option id="{{$canoe->id}}" value="{{$canoe->id}}">{{ $canoe->name . " : " . $canoe->numberOfPlace}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <p>List of rowers</p>
                            <div class="relative mt-2 mb-1">
                                <select data-te-select-init multiple value="" name="rowers[]">
                                    @foreach ($rowers as $rower)
                                    <option id="{{$rower->id}}" value="{{$rower->id}}">{{ $rower->first_name . " " . $rower->last_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="inline-block rounded bg-slate-300 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-slate-400 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-slate-500">
                                Edit Slot
                            </button>
                            <button
                            type="button"
                            class="inline-block rounded bg-primary-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-100 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-primary-accent-200"
                            data-te-modal-dismiss
                            data-te-ripple-init
                            data-te-ripple-color="light">
                            Cancel
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
