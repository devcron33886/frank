<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id' => 1,
                'title' => 'user_management_access',
            ],
            [
                'id' => 2,
                'title' => 'permission_create',
            ],
            [
                'id' => 3,
                'title' => 'permission_edit',
            ],
            [
                'id' => 4,
                'title' => 'permission_show',
            ],
            [
                'id' => 5,
                'title' => 'permission_delete',
            ],
            [
                'id' => 6,
                'title' => 'permission_access',
            ],
            [
                'id' => 7,
                'title' => 'role_create',
            ],
            [
                'id' => 8,
                'title' => 'role_edit',
            ],
            [
                'id' => 9,
                'title' => 'role_show',
            ],
            [
                'id' => 10,
                'title' => 'role_delete',
            ],
            [
                'id' => 11,
                'title' => 'role_access',
            ],
            [
                'id' => 12,
                'title' => 'user_create',
            ],
            [
                'id' => 13,
                'title' => 'user_edit',
            ],
            [
                'id' => 14,
                'title' => 'user_show',
            ],
            [
                'id' => 15,
                'title' => 'user_delete',
            ],
            [
                'id' => 16,
                'title' => 'user_access',
            ],
            [
                'id' => 17,
                'title' => 'category_create',
            ],
            [
                'id' => 18,
                'title' => 'category_edit',
            ],
            [
                'id' => 19,
                'title' => 'category_show',
            ],
            [
                'id' => 20,
                'title' => 'category_delete',
            ],
            [
                'id' => 21,
                'title' => 'category_access',
            ],
            [
                'id' => 22,
                'title' => 'product_create',
            ],
            [
                'id' => 23,
                'title' => 'product_edit',
            ],
            [
                'id' => 24,
                'title' => 'product_show',
            ],
            [
                'id' => 25,
                'title' => 'product_delete',
            ],
            [
                'id' => 26,
                'title' => 'product_access',
            ],
            [
                'id' => 27,
                'title' => 'event_create',
            ],
            [
                'id' => 28,
                'title' => 'event_edit',
            ],
            [
                'id' => 29,
                'title' => 'event_show',
            ],
            [
                'id' => 30,
                'title' => 'event_delete',
            ],
            [
                'id' => 31,
                'title' => 'event_access',
            ],
            [
                'id' => 32,
                'title' => 'newsletter_create',
            ],
            [
                'id' => 33,
                'title' => 'newsletter_edit',
            ],
            [
                'id' => 34,
                'title' => 'newsletter_show',
            ],
            [
                'id' => 35,
                'title' => 'newsletter_delete',
            ],
            [
                'id' => 36,
                'title' => 'newsletter_access',
            ],
            [
                'id' => 37,
                'title' => 'setting_access',
            ],
            [
                'id' => 38,
                'title' => 'shop_create',
            ],
            [
                'id' => 39,
                'title' => 'shop_edit',
            ],
            [
                'id' => 40,
                'title' => 'shop_show',
            ],
            [
                'id' => 41,
                'title' => 'shop_delete',
            ],
            [
                'id' => 42,
                'title' => 'shop_access',
            ],
            [
                'id' => 43,
                'title' => 'home_slide_create',
            ],
            [
                'id' => 44,
                'title' => 'home_slide_edit',
            ],
            [
                'id' => 45,
                'title' => 'home_slide_show',
            ],
            [
                'id' => 46,
                'title' => 'home_slide_delete',
            ],
            [
                'id' => 47,
                'title' => 'home_slide_access',
            ],
            [
                'id' => 48,
                'title' => 'order_create',
            ],
            [
                'id' => 49,
                'title' => 'order_edit',
            ],
            [
                'id' => 50,
                'title' => 'order_show',
            ],
            [
                'id' => 51,
                'title' => 'order_delete',
            ],
            [
                'id' => 52,
                'title' => 'order_access',
            ],
            [
                'id' => 53,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
