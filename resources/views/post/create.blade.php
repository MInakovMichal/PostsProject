<x-app-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('post') }}" enctype="multipart/form-data">
        @csrf

        <div>
            <x-input-label for="value" :value="__('post.value')" />
            <x-textarea id="value" name="value" :value="old('value')" />
            <x-input-error :messages="$errors->get('value')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="image" :value="__('post.image')" />
            <x-image-input
                id="image"
                name="image"
                :hasValue="!empty(old('image'))"
                :clearId="'clear-image'"
            />
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-3">
                {{ __('post.buttons.add') }}
            </x-primary-button>
        </div>
    </form>
</x-app-layout>
