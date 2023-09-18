<x-app-layout>
    <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
       href="{{ route('post') }}">
        {{ __('post.buttons.add') }}
    </a>
    <div>
        @foreach($posts as $post)
            <div class="post" data-post-id="{{ $post->getId() }}">
                {{ $post->getUser()->getName() . ' • '}}

                @php
                    $targetDateTime = $post->getCreatedAt();
                    $targetTimestamp = strtotime($targetDateTime);
                    $currentTimestamp = time();
                    $differenceInSeconds = ($targetTimestamp - $currentTimestamp) * (-1);

                if ($differenceInSeconds < 60) {
                    $result = $differenceInSeconds . ' ' . __('post.time.seconds');
                } elseif ($differenceInSeconds < 3600) {
                    $result = floor($differenceInSeconds / 60) . ' ' . __('post.time.minutes');
                } elseif ($differenceInSeconds < 86400) {
                    $result = floor($differenceInSeconds / 3600) . ' ' . __('post.time.hours');
                } else {
                    $result = floor($differenceInSeconds / 86400) . ' ' . __('post.time.days');
                }
                @endphp
                {{ $result }}
                @if (isAdmin())
                    <x-delete-button class="delete-post" style="float: right">
                        {{ __('post.buttons.delete') }}
                    </x-delete-button>
                @endif
                <hr class="custom-hr">
                @if($post->hasValue())
                    <div class="post-content">
                        {!! $post->getValue() !!}
                    </div>
                @endif

                @if($post->hasImage())
                    <img src="{{ asset('storage/' . $post->getImagePath()) }}" alt="Post Image">
                @endif
            </div>
        @endforeach
    </div>
</x-app-layout>
