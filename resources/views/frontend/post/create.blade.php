<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl w-6/12 mt-5 mx-auto sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden sm:rounded-md">
                <form action="{{route('post.store')}}" method="POST">
                    @csrf
                    @method('POST')
                    @include('frontend.post.field')
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <a href="{{route('dashboard')}}" class="text-red-600 m-3">Cancel</a>
                        <button type="submit"  class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:text-blue-700">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
