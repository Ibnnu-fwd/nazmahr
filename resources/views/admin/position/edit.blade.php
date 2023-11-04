<x-app-layout>
    @section('title', 'Ubah Jabatan')

    <x-breadcrumb name="admin.position.edit" :data="$position" />

    <x-card-container>
        <form action="{{ route('admin.position.update', $position->id) }}" method="POST">
            @csrf
            @method('PUT')
            <x-input id="name" name="name" label="{{ __('Jabatan') }}" value="{{ $position->name }}"
                type="text" />
            <x-button id="edit" label="{{ __('Ubah') }}" type="submit" />
        </form>
    </x-card-container>

</x-app-layout>
