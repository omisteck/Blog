<?php

namespace App\Console\Commands;

use App\Jobs\FetchPostJob;
use Illuminate\Console\Command;

class FetchPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This fetch post from the customer other blogging platform';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        FetchPostJob::dispatch();
    }
}
