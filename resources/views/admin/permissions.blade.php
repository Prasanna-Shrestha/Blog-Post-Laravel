@foreach ($roles as $role)
    <form method="POST" action="{{ route('admin.permissions.update', $role->id) }}">
        @csrf

        <h2>{{ $role->name->value }}</h2>

        @foreach ($permissions as $permission)
            <label>
                <input
                    type="checkbox"
                    name="permissions[]"
                    value="{{ $permission->id }}"
                    {{ $role->permissions->contains('id', $permission->id) ? 'checked' : '' }}
                >
                {{ $permission->label }}
            </label>
        @endforeach

        <button type="submit">Save</button>
    </form>
@endforeach