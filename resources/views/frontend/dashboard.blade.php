<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-items-end	">
            <h2 class="font-semibold w-3/5  text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <p class="w-2/3 justify-end align-middle text-end	 ">
                <a href="{{route('post.create')}}" class="text-end	text-green-800">Post Now</a>
            </p>
        </div>
    </x-slot>
    <div class="py-12 flex flex-wrap">
        <div class="max-w-7xl w-3/5 mx-auto sm:px-6 lg:px-8">
            <div class="w-3/5 border-b border-white">
                <div class=" text-blue-700">
                Welcome Back Mr {{$user->name}} !!!
                </div>
            </div>
        </div>
        <div class="flex w-full">
            <x-filter class="w-4/12 flex items-start mt-0 m-auto" />
            <x-post-list class="w-3/5" :posts="$posts"/>
         </div>
    </div>
</x-app-layout>
