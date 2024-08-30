<div class="border border-gray-300 dark:border-gray-600 p-5 rounded-lg">
    <p class="font-semibold text-gray-800 dark:text-gray-200">Create Role</p>
    <form action="{{ route('settings.roles-and-permissions.createRole') }}" method="POST" class="mt-4">
        @csrf
        <x-bladewind::input type="text" name="name" label="Role Name" id="role-name-input" /> 
        <x-bladewind::button icon="folder-minus" can_submit="true">
            Create Role
        </x-bladewind::button>
    </form>
</div>


<div class="border border-gray-300 dark:border-gray-600 p-5 rounded-lg mt-4">
    <p class="font-semibold text-gray-800 dark:text-gray-200">Assign Role</p>
    <form action="{{ route('settings.roles-and-permissions.assignRoleToUser') }}" method="POST" class="mt-4">
        @csrf 
        @if(!$users->isEmpty())
            <x-bladewind::select label_key="name" value_key="id" :data="$users" label="User" name="user" id="user-input" />
        @else
            <x-bladewind::input type="text" label="No User in database?" disabled /> 
        @endif

        @if(!$users->isEmpty())
            <x-bladewind::select label_key="name" value_key="id" :data="$roles" label="role" name="role" id="user-input" />
        @else
            <x-bladewind::input type="text" label="No Role in database?" disabled /> 
        @endif

        <x-bladewind::button icon="folder-minus" can_submit="true">
            Assign Role
        </x-bladewind::button>
    </form>
</div>