<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-green-400 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("List of all users!") }}
                </div>
            </div>
        </div>
    </div>
<table class="border-separate border-spacing-2 border-2 border-slate-400 bg-white table-auto mx-auto">
<!-- Table Header -->
        <thead>
            <tr class="">
                <th class="border-2 border-indigo-500 px-2 text-center">Name</th>
                <th class="border-2 border-indigo-500 px-2 text-center">Email</th>
                <th class="border-2 border-indigo-500 px-2 text-center">Phone number</th>
                <th class="border-2 border-indigo-500 px-2 text-center">Status</th>
                <th class="border-2 border-indigo-500 px-2 text-center">Actions</th>
            </tr>
        </thead>
<!-- Table Body -->
    <tbody id="tableSlots" >
            @foreach ($users as $user)
                <tr class="odd:bg-white even:bg-slate-300">
                    <td class="px-2 text-center">{{$user->first_name . ' ' . $user->last_name}}</td>
                    <td class="px-2 text-center">{{$user->email}}</td>
                    <td class="px-2 text-center">{{$user->phone_number}}</td>
                    <td class="px-2 text-center">{{$user->status}}</td>
                    <td class="bg-white">
                        <button 
                            class="p-2 bg-amber-300"
                            data-te-toggle="modal"
                            data-te-target="#modalEditUser"
                            data-te-whatever="{{json_encode([
                            'id' => $user->id,
                            'first_name' => $user->first_name,
                            'last_name' => $user->last_name,
                            'email' => $user->email,
                            'phone_number' => $user->phone_number,
                            'status' => $user->status,
                            ])}}"
                            data-te-ripple-init
                            data-te-ripple-color="light"
                            >
                            Edit
                        </button>
                        <x-danger-button
                        data-te-toggle="modal"
                        data-te-target="#modalDeleteUser"
                        data-te-whatever="{{$user->id}}"
                        data-te-ripple-init
                        data-te-ripple-color="light">
                        Delete
                        </x-danger-button>
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
</table>
<!-- New User -->
    <div class="flex justify-center">
        <section class="bg-white dark:bg-gray-900">
        <h2 class="my-4 text-xl font-bold text-gray-900 dark:text-white">Add an user</h2>
            <div class="my-4 py-4 px-4 mx-auto max-w-2xl border-black border-2 rounded-l">
                <form method="POST" action="{{ route('add_user') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First name</label>
                        <input type="text" id="first_name" name="first_name" value="{{old('first_name')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" required>
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last name</label>
                        <input type="text" id="last_name" name="last_name" value="{{old('last_name')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Doe" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone number</label>
                        <input type="tel" id="phone" name="phone" value="{{old('phone')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="89507772" pattern="[8][7-9][0-9]{6}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email address</label>
                        <input type="email" id="email" name="email" value="{{old('email')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="john.doe@company.com" required>
                    </div> 
                    <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an status</label>
                    <select id="status" name="status" class="bg-gray-50 mb-3 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="admin">Admin</option>
                        <option value="trainer">Trainer</option>
                        <option value="rower">Rower</option>
                    </select>
                    <div class="mb-3">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" id="password" name="password"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••" required>
                    </div>
                    @if ($errors->has('password'))
                        @foreach ($errors->get('password') as $message) 
                            <p class="text-red-600 text-xs"> {{$message}} </p> 
                        @endforeach
                    @endif
                    <div class="mb-3">
                        <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                        <input type="password" id="confirm_password" name="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••" required>
                    </div> 
                    @if ($errors->has('password_confirmation'))
                        @foreach ($errors->get('password_confirmation') as $message) 
                            <p class="text-red-600 text-xs mb-2"> {{$message}} </p> 
                        @endforeach
                    @endif
                    <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-gray-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                        Confirm
                    </button>
                </form>
            </div>
        </section>
    </div>

<!--Modal Delete -->
    <div
        data-te-modal-init
        class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
        id="modalDeleteUser"
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
                    Are you sure you want to delete this user ?
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
                    <form method="post" action="{{ route('user.destroy') }}" class="p-6">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="user_id" value="">
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

<!-- Modal Edit User -->
    <div
    data-te-modal-init
    class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
    id="modalEditUser"
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
                    <form method="POST" action="{{ route('edit_user') }}">
                        @csrf
                        @method('put')
                        <input type="hidden" name="user_id" value=""/>
                        <div class="mb-3">
                            <label for="first_name_edit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First name</label>
                            <input type="text" id="first_name_edit" name="first_name_edit" value="{{old('first_name_edit')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" required>
                        </div>
                        <div class="mb-3">
                            <label for="last_name_edit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last name</label>
                            <input type="text" id="last_name_edit" name="last_name_edit" value="{{old('last_name_edit')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Doe" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone_edit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone number</label>
                            <input type="tel" id="phone_edit" name="phone_edit" value="{{old('phone_edit')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="89507772" pattern="[8][7-9][0-9]{6}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email_edit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email address</label>
                            <input type="email_edit" id="email_edit" name="email_edit" value="{{old('email_edit')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="john.doe@company.com" required>
                        </div> 
                        <label for="status_edit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User's status</label>
                        <select id="status_edit" name="status_edit" class="bg-gray-50 mb-3 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                            <option name="admin" value="admin">Admin</option>
                            <option name="trainer" value="trainer">Trainer</option>
                            <option name="rower" value="rower">Rower</option>
                        </select>
                        <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-gray-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                            Confirm
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
