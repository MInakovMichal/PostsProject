<x-app-layout>
    <form method="POST" action="{{ route('notification') }}" enctype="multipart/form-data">
        @csrf

        <div>
            <x-input-label for="user" :value="__('notification.user')" />
            <label>
                <select class="select-input" name="user">
                    <option value="" disabled selected>{{ __('notification.select_option') }}</option>
                    @foreach($users as $user)
                        <option value="{{ $user->getId() }}" {{ old('user') == $user->getId() ? 'selected' : '' }}>{{ $user->getName() }}</option>
                    @endforeach
                </select>
            </label>
            <x-input-error :messages="$errors->get('user')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="value" :value="__('notification.value')" />
            <x-textarea id="value" name="value" :value="old('value')" />
            <x-input-error :messages="$errors->get('value')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="image" :value="__('notification.image')" />
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
                {{ __('notification.send') }}
            </x-primary-button>
        </div>
    </form>
</x-app-layout>
