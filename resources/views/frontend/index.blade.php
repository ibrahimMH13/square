<x-app-layout>
    <div class="py-12">
        @forelse($posts as $post)
            <div class="max-w-7xl w-6/12 mt-5 mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="pt-1 pl-4 bg-white border-b border-gray-200">
                           <span class="text-xs"><a href="{{route('post.user',$post->user)}}" class="text-blue-700">{{$post->user->name}}</a> post</span>
                          <a href="{{route('post.show',$post)}}">
                              <p class="block text-xl pr-1"> {{$post->title}}</p>
                          </a>
                    </div>
                    <div class="p-4 bg-white text-base text-gray-500 border-b border-gray-200">
                        {!! \Illuminate\Support\Str::limit($post->body,200) !!}
                        <a href="{{route('post.show',$post)}}" class="text-blue-700 text-sm">more</a>
                        <p class="pt-4 mt-1 text-xs">
                            <span>Published since</span>
                         {{$post->created_at->diffForHumans()}}
                        </p>
                    </div>
                </div>
            </div>
        @empty
             <div class="max-w-7xl mr-10 text-gray-500 my-32 mx-auto sm:px-6 lg:px-8">
                 <div class="w-6/12 m-auto">
                     Uhhhm,No data feed here,post now to be the first one
                 </div>
             </div>
        @endforelse
        @if($posts && method_exists($posts,'links'))
            <div class="max-w-7xl w-6/12 mt-5 mx-auto sm:px-6 lg:px-8">
                      {{$posts->links()}}
            </div>
         @endif
    </div>
</x-app-layout>
