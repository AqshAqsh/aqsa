<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class DeleteNonAdminUsers extends Command
{
    protected $signature = 'user:delete-non-admins';
    protected $description = 'Delete all users except for admin users';

    public function handle()
    {
        // Delete all users who are not admins
        $deletedCount = User::where('role', '!=', 'admin')->delete();
        $this->info("Deleted $deletedCount non-admin users.");
    }
}