<div class="bg-white border border-gray-200 rounded-lg shadow-lg">
    <div class="mt-4 mb-4 text-center">
        @if (session()->has('success'))
            <span class="px-3  py-1 bg-green-600 text-white rounded">{{ session('success') }}</span>
        @endif


        @if (session()->has('error'))
            <span class="px-3 mt-4 mb-4 text-center py-1 bg-red-600 text-white rounded">{{ session('error') }}</span>
        @endif
    </div>

@if($create)

    <!-- Card Header -->
        <div class="bg-indigo-600 py-4 px-6 flex items-center justify-between">
            <h1 class="text-xl text-white font-semibold">{{$editEducation ? 'Update Education' : 'Add Education'}}</h1>

        </div>

        <!-- Card Body -->
        <form class="py-6 px-4 sm:px-6" wire:submit.prevent="store">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="degree" class="block text-sm font-medium text-gray-700 mb-1">Degree</label>
                    <div class="relative">
                        <select name="degree" id="degree" wire:model.live="degree"
                                class="select2 block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option>Select Degree</option>
                            @foreach($degreeList as $list)
                                <option
                                        value="{{$list->id}}" {{$this->degree->parent_id === $list->id? 'selected' : ''}}>{{$list->name}}</option>
                            @endforeach
                        </select>

                    </div>

                    @error('degree')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="degree" class="block text-sm font-medium text-gray-700 mb-1">Sub Degree</label>
                    <div class="relative">
                        <select name="degree" id="degree" wire:model.live="degree"
                                class="select2 block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option>Select Degree</option>
                            @foreach($degreeList as $list)
                                <option
                                        value="{{$list->id}}" {{$this->degree->parent_id === $list->id? 'selected' : ''}}>{{$list->name}}</option>
                            @endforeach
                        </select>

                    </div>

                    @error('degree')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>


                <!-- Name field -->
                <div>
                    <label for="board" class="block text-sm font-medium text-gray-700 mb-1">Board</label>
                    <input id="board" name="board" type="text" wire:model.live="board"
                           class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                           placeholder="BISE Peshawar">
                    @error('board')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror

                </div>
                <!-- Last Name field -->
                <div>
                    <label for="total_marks" class="block text-sm font-medium text-gray-700 mb-1">Total Marks</label>
                    <input id="total_marks" name="total_marks" type="number" min="0" wire:model.live="total_marks"
                           class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                           placeholder="1100">
                    @error('total_marks')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="obtained_marks"
                           class="block text-sm font-medium text-gray-700 mb-1">Obtained Marks</label>
                    <input id="obtained_marks" name="obtained_marks" type="number" min="0"
                           wire:model.live="obtained_marks"
                           class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                           placeholder="900">
                    @error('obtained_marks')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="percentage" class="block text-sm font-medium text-gray-700 mb-1">Percentage</label>
                    <input id="percentage" name="percentage" type="text" wire:model.live="percentage"
                           class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    >
                    @error('percentage')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="grade" class="block text-sm font-medium text-gray-700 mb-1">Grade</label>
                    <input id="grade" name="grade" type="text" wire:model.live="grade"
                           class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                           placeholder="A+">
                    @error('grade')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Email field -->
                <div>
                    <label for="result_declaration_date" class="block text-sm font-medium text-gray-700 mb-1">Result
                        Decleration Date</label>
                    <input id="result_declaration_date" name="result_declaration_date" type="date"
                           wire:model.live="result_declaration_date"
                           class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    >
                    @error('result_declaration_date')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

            </div>
            <button type="submit"
                    wire:loading.attr="disabled"
                    class="mt-6 max-w-md bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-white">
                <span wire:loading wire:target="store">Saving...</span>
                <span wire:loading.remove wire:target="store">Submit</span>
            </button>
            <x-button type="button" wire:click="toggleSection">
                Reset
            </x-button>

        </form>



    @else


        <div class="bg-indigo-600 py-4 px-6 flex items-center justify-between">
            <h1 class="text-xl text-white font-semibold">Education Management</h1>
            <div>
                <x-button wire:click="add">
                    Create Education
                </x-button>
            </div>
        </div>


        <!-- Card Body -->
        <div class="mt-5 px-8">
            <div class="flex justify-between">
                <div class="p-4">
                    <input type="search" wire:model.live.debounce.500ms="search" placeholder="Search"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"/>
                </div>
            </div>
            <table class="table-auto w-full border mt-5">
                <thead>
                <tr>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            No
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Degree
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Obtained Marks
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Total Marks
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Percentage
                        </div>
                    </th>

                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Grade
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Result Date
                        </div>
                    </th>
                    <th class="border px-4 py-2" width="150px">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($educations as $education)
                    <tr>
                        <td class="border px-4 py-2">{{ $education->id }}</td>
                        <td class="border px-4 py-2">{{ $education->degree->name }}</td>
                        <td class="border px-4 py-2">{{ $education->board }}</td>
                        <td class="border px-4 py-2">{{ $education->obtained_marks }}</td>
                        <td class="border px-4 py-2">{{ $education->total_marks }}</td>
                        <td class="border px-4 py-2">{{ $education->percentage }}</td>
                        <td class="border px-4 py-2">{{ $education->grade }}</td>
                        <td class="border px-4 py-2">{{ $education->result_declaration_date }}</td>
                        <td class="border px-4 py-2 inline-flex w-full">
                            <x-button class="ml-3" wire:click="edit({{$education->id}})" wire:loading.attr="disabled">
                                <i class="fas fa-edit"></i>
                            </x-button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="border px-4 py-2" colspan="7">No Record Found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

        </div>
        <!-- Card Footer -->
        <div class="py-4 px-8">
            {{ $educations->links() }}
        </div>

    @endif

</div>