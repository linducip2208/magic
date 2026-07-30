@extends('panel.layout.settings')
@section('title', __('Manage Permissions'))
@section('titlebar_actions')
    <x-button href="{{ route('dashboard.admin.users.index') }}">
        {{ __('User Management') }}
    </x-button>
@endsection
@section('settings')
    <form
        class="flex flex-col gap-5"
        action="{{ route('dashboard.admin.users.permissionSave') }}"
        method="POST"
    >
        @csrf
        <input type="hidden" name="role" value="{{ $selectedRole }}">

        <div class="flex items-center gap-3 mb-4">
            <x-forms.input
                class="w-48"
                id="role_selector"
                type="select"
                name="role_selector"
                label="{{ __('Select Role') }}"
                onchange="window.location.href='?role='+this.value"
            >
                <option value="admin" {{ $selectedRole === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ $selectedRole === 'user' ? 'selected' : '' }}>User</option>
            </x-forms.input>
        </div>

        <x-form-step class="mb-4" label="{{ $selectedRole === 'user' ? __('User Menu Permissions') : __('Admin Privileges') }}" />

        <div class="mb-6 grid grid-cols-2 gap-4 md:grid-cols-2">
            @foreach ($availablePermissions as $permName)
                <x-forms.input
                    class:container="h-full bg-input-background"
                    class:label="w-full border h-full rounded px-3 py-4 hover:bg-foreground/5 transition-colors"
                    class="checked-item"
                    id="flex_check_{{ $permName }}"
                    :checked="in_array($permName, $permissions)"
                    type="checkbox"
                    name="permissionItems[]"
                    value="{{ $permName }}"
                    label="{{ str_replace('_', ' ', ucfirst($permName)) }}"
                />
            @endforeach
        </div>

        <x-button type="submit">
            {{ __('Save') }}
        </x-button>
    </form>
@endsection
