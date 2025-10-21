<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class FixUserPasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:fix-passwords';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix user passwords that are not using bcrypt';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking for users with non-bcrypt passwords...');

        $users = User::all();
        $fixed = 0;

        foreach ($users as $user) {
            // Check if password is not bcrypt (bcrypt hashes start with $2y$ and are 60 chars)
            if (!str_starts_with($user->password, '$2y$') || strlen($user->password) !== 60) {
                $this->warn("Fixing password for user: {$user->email}");
                
                // Hash the current password (assuming it's plain text)
                $user->password = Hash::make($user->password);
                $user->save();
                
                $fixed++;
            }
        }

        if ($fixed > 0) {
            $this->info("✅ Fixed {$fixed} user password(s)!");
            $this->comment("Note: Plain text passwords were hashed. Users should reset their passwords.");
        } else {
            $this->info("✅ All passwords are already properly hashed!");
        }

        return 0;
    }
}
