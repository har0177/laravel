<div class="bg-white border border-gray-200 rounded-lg shadow-lg">
    @if (session()->has('success'))
        <x-flash-success-message message="{{ session('success') }}"/>
    @endif
    @if (session()->has('error'))
        <x-flash-error-message message="{{ session('error') }}"/>
    @endif


    <div class="bg-indigo-500 py-4 px-6 flex items-center justify-between">
        <h1 class="text-xl text-white font-semibold">SMS Management</h1>

    </div>

    <!-- Card Body -->
    <form class="py-6 px-4 sm:px-6" wire:submit.prevent="sendSMS">

        <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Send SMS To</label>
        <div class="type">
            <select name="type" id="type"
                    wire:model="type"
                    class=" block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <option value="">Select from List</option>
                <option value="student">Students</option>
                <option value="employee">Employee</option>
                <option value="parents">Parents</option>
            </select>

            @error('type')
            <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>


        <label for="sms" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
        <textarea id="sms" name="sms" wire:model="sms"
                  class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                  placeholder="John Doe">
					</textarea>
        @error('sms')
        <span class="text-red-600 text-sm">{{ $message }}</span>
        @enderror


        <button type="submit"
                wire:loading.attr="disabled"
                class="mt-6 max-w-md bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-white">
            <span wire:loading wire:target="sendSMS">Sending...</span>
            <span wire:loading.remove wire:target="sendSMS">Send SMS</span>
        </button>
        <x-button type="reset" name="reset">
            Reset
        </x-button>
    </form>


</div>
