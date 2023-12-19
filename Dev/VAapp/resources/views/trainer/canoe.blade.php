<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-teal overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-ecru">
                    {{ __("List of all canoes!") }}
                </div>
            </div>
        </div>
    </div>
<!-- Table Header -->
    <table class="border-separate border-spacing-2 border-2 rounded-xl border-black bg-gradient-to-r from-photo_blue to-azure_web table-auto mx-auto">
        <thead>
            <tr class="">
                <th class="border-2 border-teal rounded-xl px-2 text-center">Name</th>
                <th class="border-2 border-teal rounded-xl px-2 text-center">Number of Place</th>
                <th class="border-2 border-teal rounded-xl px-2 text-center">Actions</th>
            </tr>
        </thead>
<!-- Table Body -->
        <tbody>
            @foreach ($canoes as $canoe)
            <tr>
                <td class="px-2 text-center">{{$canoe->name}}</td>
                <td class="px-2 text-center">{{$canoe->numberOfPlace}}</td>
                <td>
                    <button 
                        class="p-2 bg-hunyadi_yellow rounded-xl"
                        data-te-toggle="modal"
                        data-te-target="#modalEditCanoe"
                        data-te-whatever="{{json_encode([
                        'id' => $canoe->id,
                        'name' => $canoe->name,
                        'numberOfPlace' => $canoe->numberOfPlace
                        ])}}"
                        data-te-ripple-init
                        data-te-ripple-color="light"
                        >
                        Edit
                    </button>
                    <x-danger-button
                    data-te-toggle="modal"
                    data-te-target="#modalDeleteCanoe"
                    data-te-whatever="{{$canoe->id}}"
                    data-te-ripple-init
                    data-te-ripple-color="light">
                    Delete
                    </x-danger-button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <button class="flex py-4 mx-auto"
            data-te-toggle="modal"
            data-te-target="#modalNewCanoe"
            data-te-ripple-init>
        <svg width="50px" height="50px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path opacity="0.5" d="M2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C22 4.92893 22 7.28595 22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12Z" stroke="#1C274C" stroke-width="1.5"/>
            <path d="M15 12L12 12M12 12L9 12M12 12L12 9M12 12L12 15" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
        </svg>
    </button>

<!-- New canoe -->
    <div 
    data-te-modal-init
    class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
    id="modalNewCanoe"
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
                    Create a new canoe
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
                        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">New Canoe</h2>
                        <form method="POST" action="{{ route('add_canoe') }}">
                            @csrf
                            <div
                                class="relative mt-2 mb-1">
                                <input type="text" name="vaa_name"/>
                            </div>
                            @if ($errors->has('vaa_name'))
                                @foreach ($errors->get('vaa_name') as $message) 
                                    <p class="text-red-600 text-xs"> {{$message}} </p> 
                                @endforeach
                            @endif
                            <div
                                class="relative mt-2 mb-1">
                                <select name="numberOfPlace" data-te-select-init>
                                    <option value="1">One place</option>
                                    <option value="3">Three places</option>
                                    <option value="6">Six places</option>
                                </select>
                            </div>
                            @if ($errors->has('numberOfPlace'))
                                @foreach ($errors->get('numberOfPlace') as $message) 
                                    <p class="text-red-600 text-xs"> {{$message}} </p> 
                                @endforeach
                            @endif
                            <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-gray-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                                Add Canoe
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
    id="modalDeleteCanoe"
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
                <form method="post" action="{{ route('canoe.destroy') }}" class="p-6">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="canoe_id" value="">
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
    id="modalEditCanoe"
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
                        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edition of canoe</h2>
                        <form method="POST" action="{{route('edit_canoe')}}">
                            @csrf
                            @method('put')
                            <input type="hidden" name="canoe_id" value=""/>
                            <div
                                class="relative mt-2 mb-1">
                                <input type="text" name="vaa_name_edit" value=""/>
                            </div>
                            @if ($errors->has('vaa_name_edit'))
                                @foreach ($errors->get('vaa_name_edit') as $message) 
                                    <p class="text-red-600 text-xs"> {{$message}} </p> 
                                @endforeach
                            @endif
                            <div
                                class="relative mt-2 mb-1">
                                <select name="numberOfPlaceEdit" disabled data-te-select-init>
                                    <option id="1">One place</option>
                                    <option id="3">Three places</option>
                                    <option id="6">Six places</option>
                                </select>
                            </div>
                            <button type="submit" class="inline-block rounded bg-slate-300 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-slate-400 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-slate-500">
                                Edit Canoe
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
