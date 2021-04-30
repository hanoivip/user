<?php

namespace Hanoivip\User\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Hanoivip\User\User;
use Hanoivip\User\Mail\UserNoticed;

class AdminNotice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:notice {user? : A username to send.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Admin send a notice to all/user via email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->hasArgument('user'))
            $username = $this->argument('user');
        if (isset($username))
        {
            $user = User::where('name', $username)->first();
            if (isset($user))
            {
                Mail::send(new UserNoticed($user));
                $this->info("Notice sent to a user!");
            }
            else
            {
                $this->error("User with username {$username} not found.");
            }
        }
        else 
        {
            $users = User::all();
            if (count($users) > 0)
            {
                $bar = $this->output->createProgressBar(count($users));
                foreach ($users as $user)
                {
                    Mail::queue(new UserNoticed($user));
                    $bar->advance();
                }
                $bar->finish();
                $this->info("Notice sent to all user!");
            }
            else 
            {
                $this->info("Sorry. There is no user in database.");
            }
        }
    }
}
