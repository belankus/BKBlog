<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminRole = Role::create(['name' => 'superadmin']);
        $userRole = Role::create(['name' => 'user']);
        $visitorRole = Role::create(['name' => 'visitor']);

        $createPostPermission = Permission::where('name', 'create post')->first();
        $editPostPermission = Permission::where('name', 'edit post')->first();
        $deletePostPermission = Permission::where('name', 'delete post')->first();
        $createUserPermission = Permission::where('name', 'create user')->first();
        $editUserPermission = Permission::where('name', 'edit user')->first();
        $deleteUserPermission = Permission::where('name', 'delete user')->first();
        $createCommentPermission = Permission::where('name', 'create comment')->first();
        $editCommentPermission = Permission::where('name', 'edit comment')->first();
        $deleteCommentPermission = Permission::where('name', 'delete comment')->first();
        $createCategoryPermission = Permission::where('name', 'create category')->first();
        $editCategoryPermission = Permission::where('name', 'edit category')->first();
        $deleteCategoryPermission = Permission::where('name', 'delete category')->first();
        $viewCategoryPermission = Permission::where('name', 'view category')->first();
        $createTagPermission = Permission::where('name', 'create tag')->first();
        $editTagPermission = Permission::where('name', 'edit tag')->first();
        $deleteTagPermission = Permission::where('name', 'delete tag')->first();
        $viewTagPermission = Permission::where('name', 'view tag')->first();
        $editRolePermission = Permission::where('name', 'edit role')->first();

        $superAdminRole->givePermissionTo([
            $createPostPermission,
            $editPostPermission,
            $deletePostPermission,
            $createUserPermission,
            $editUserPermission,
            $deleteUserPermission,
            $createCommentPermission,
            $editCommentPermission,
            $deleteCommentPermission,
            $createCategoryPermission,
            $editCategoryPermission,
            $deleteCategoryPermission,
            $viewCategoryPermission,
            $createTagPermission,
            $editTagPermission,
            $deleteTagPermission,
            $viewTagPermission,
            $editRolePermission
        ]);
        $userRole->givePermissionTo([
            $createPostPermission,
            $editPostPermission,
            $deletePostPermission,
            $createUserPermission,
            $editUserPermission,
            $deleteUserPermission,
            $createCommentPermission,
            $editCommentPermission,
            $deleteCommentPermission,
            $viewCategoryPermission,
            $viewTagPermission
        ]);
        $visitorRole->givePermissionTo([
            $createCommentPermission, $editCommentPermission, $deleteCommentPermission, $createUserPermission,
            $editUserPermission,
            $deleteUserPermission,
        ]);
    }
}
