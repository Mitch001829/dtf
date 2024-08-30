<div class="border border-gray-300 dark:border-gray-600 p-5 rounded-lg mt-4">

    <div class="row rounded-4 w-100 boxshadow-md bgcolor-clear-white px-3 py-3 mt-4">
        <form action="{{ route('settings.roles-and-permissions.assignPermission') }}" method="POST">
            @csrf

            <select class="form-control input-control bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent min-w-full" name="role" id="role">
            <option value="0" default>Select Role</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
            
   

            <div class="col-md-12 d-flex flex-wrap border-top mt-3">
                @php
                    // Group permissions by 'category', using 'Uncategorized' for empty categories
                    $groupedPermissions = $permissions->groupBy(function($permission) {
                        return $permission->category ?: 'Uncategorized';
                    });
                @endphp
                <table class="dark:bg-slate-900" id="permission-table">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Permissions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($groupedPermissions as $category => $perms)
                            <tr class="">
                                <td class="pt-4 pb-4 text-left border border-gray-300 dark:border-gray-600">{{ $category }}</td>
                                <td class="pt-4 pb-4 border border-gray-300 dark:border-gray-600">
                                    <div class="flex flex-wrap">
                                        @foreach ($perms as $permission)
                                            <div class="my-2 w-max p-2 border border-gray-300 dark:border-gray-600 rounded-lg mx-2">
                                                <input class="form-check-input bg-white dark:bg-slate-600 rounded-lg" type="checkbox" name="{{ $permission->name }}" value="{{ $permission->name }}" id="{{ $permission->name }}">
                                                <label class="form-check-label px-2" for="{{ $permission->name }}">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="border-top mt-3"></div>
            <x-bladewind::button icon="folder-minus" can_submit="true">
                Submit Form
            </x-bladewind::button>
        </form>
    </div>
</div>



<script>
    $('#permission-table').DataTable({
        order: [[0, 'desc']],
        "pageLength": 100,
        "lengthMenu": [[100], [100]], // Set to 100 and hide other options
        
    });

    $(document).on("change", "#role", function() {
        var roleId = $(this).val();
        
        if(roleId !== "0"){
            $.ajax({
                type: 'GET',
                url: `{{ route("settings.roles-and-permissions.getRolePermission", ["id" => ":roleId"]) }}`.replace(':roleId', roleId),
                data: {role_id: roleId},
                success: function(response) {
                    response["all_permissions"].map(permission=>{
                        let permission_element = document.getElementById(permission)
                        if(permission_element != null){
                            permission_element.checked = false;
                        } else {
                            console.log("Cannot find element with id: " + permission);
                        }
                        
                    });

                    response["permissions"].map(permission=>{
                        let permission_element = document.getElementById(permission)
                        if(permission_element != null){
                            permission_element.checked = true;
                        } else {
                            console.log("Cannot find element with id: " + permission);
                        }
                    });
                    
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });

    
</script>