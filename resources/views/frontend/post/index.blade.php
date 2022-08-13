<x-app-layout>
    <div class="py-12 flex">
        <x-filter class="w-4/12 flex items-start mt-0 m-auto" />
        <x-post-list class="w-8/12" :posts="$posts"></x-post-list>
    </div>
</x-app-layout>
