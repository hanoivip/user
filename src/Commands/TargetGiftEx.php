<?php

namespace Hanoivip\User\Console\Commands;

use Hanoivip\User\User;
use Hanoivip\User\Jobs\ProcessUserGift;
use Hanoivip\User\Mail\UserGift;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use CurlHelper;

class TargetGiftEx extends Command
{
    // ex: http://play.ngoalong.vn1.us testgift nlus users_nlus.json
    protected $signature = 'gift:targetex {uri} {package} {group} {file}';

    protected $description = 'Generate and send gift to players. Emails are stored in file';

    public function handle()
    {
        $uri = $this->argument('uri');
        $package = $this->argument('package');
        $group = $this->argument('group');
        $template = "emails.{$group}-gift-user";
        $file = $this->argument('file');
        
        $path = storage_path() . "/" . $file;
        $users = json_decode(file_get_contents($path), true);
        
        print_r($users);
        echo json_last_error_msg();
        
        if (count($users) > 0)
        {
            $bar = $this->output->createProgressBar(count($users));
            $count = 0;
            foreach ($users as $user)
            {
                // mailgun: freeplan: 100 mail per hour
                // mailgun: 100k plan: 2 mail per minute
                $job = (new ProcessUserGift($uri, $user["email"], $package, $template))
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
