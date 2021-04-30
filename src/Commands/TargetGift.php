<?php

namespace Hanoivip\User\Commands;

use Carbon\Carbon;
use Hanoivip\User\User;
use Hanoivip\User\Jobs\ProcessUserGift;
use Illuminate\Console\Command;

class TargetGift extends Command
{
    // ex: http://play.ngoalong.vn1.us testgift nlus game.oh.vn@gmail.com
    protected $signature = 'gift:target {uri} {package} {group} {target?}';

    protected $description = 'Generate and send gift to each player. Fetch player in database';

    public function handle()
    {
        $uri = $this->argument('uri');
        $package = $this->argument('package');
        $group = $this->argument('group');
        $template = "emails.{$group}-gift-user";
        $target = '';
        if ($this->hasArgument('target'))
        {
            $target = $this->argument('target');
            $users = User::where('email', $target)->get()->all();
        }
        else
            $users = User::all();
        if (count($users) > 0)
        {
            $bar = $this->output->createProgressBar(count($users));
            $count = 0;
            foreach ($users as $user)
            {
                // mailgun: freeplan: 100 mail per hour
                // mailgun: 100k plan: 2 mail per minute
                $job = (new ProcessUserGift($uri, $user->email, $package, $template))
                            ->delay(Carbon::now()->addSeconds($count * 30));
                dispatch($job);
                $bar->advance();
                $count++;
            }
            $bar->finish();
            $this->info("All job are queued!");
        }
        else
        {
            $this->info("Sorry. There is no user in database.");
        }
    }
}
