<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class Expiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'expire user every 5 minutes';

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
        $users = User::where('expire', 0)->get(); // return all users expire = 0
        foreach ($users as $user) {
            $user->update(['expire' => 1]);
        }
    }
}
