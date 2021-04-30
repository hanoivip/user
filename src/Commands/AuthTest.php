<?php

namespace Hanoivip\User\Commands;
use Hanoivip\User\Services\CredentialService;
use Illuminate\Console\Command;
class AuthTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:auth';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test auth in command';

    protected $credentials;
    
    public function __construct(
        CredentialService $credentials)
    {
        parent::__construct();
        $this->credentials = $credentials;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = $this->credentials->getUserCredentials('test11');
        $token = $user->createToken('ops')->accessToken;
        $this->info('Generated token:' . $token);
        $this->info('Admin user:' . print_r($user, true));
    }
}
