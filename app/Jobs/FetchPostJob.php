<?php

namespace App\Jobs;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class FetchPostJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $response = Http::get('https://candidate-test.sq1.io/api.php')->json();

        $transanformData = collect($response['articles'])->each(function ($article) {
            Post::updateOrCreate(
                ['id' => $article['id']],
                [
                    'user_id' => 1,
                    'title' => $article['title'],
                    'description' => $article['description'],
                    'publication_date' => Carbon::parse($article['publishedAt']),
                ]
            );
        });
    }
}
