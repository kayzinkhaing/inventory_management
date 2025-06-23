<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessageSeeder extends Seeder
{
    public function run()
    {
        DB::table('messages')->insert([
            ['name' => 'created_successfully', 'message' => 'Created successfully'],
            ['name' => 'updated_successfully', 'message' => 'Updated successfully'],
            ['name' => 'deleted_successfully', 'message' => 'Deleted successfully'],
            ['name' => 'action_failed', 'message' => 'An error occurred while performing the action'],
            ['name' => 'account_activated', 'message' => 'Account activated successfully'],
            ['name' => 'role_perm_assign', 'message' => 'Role and permission assigned successfully'],
            ['name' => 'USER_ROLE_PERM_DEL', 'message' => 'User, role, and permission deleted successfully'],
            ['name' => 'code_resent', 'message' => 'A new verification code has been sent to your email.'],
            ['name' => 'rate_limited', 'message' => 'Please wait before requesting another code. limited'],
            ['name' => 'session_expired', 'message' => 'Your registration session has expired. Please register again.'],
            ['name' => 'invalid_code', 'message' => 'Invalid verification code.'],
            ['name' => 'update', 'message' => 'Update successful'],
            ['name' => 'try_again', 'message' => 'Something went wrong while saving. Please try again later.'],
        ]);
    }
}
