<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

class NewUserWelcomeMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $company;

    /**
     * Create a new job instance.
     */
    public function __construct($company)
    {
        //
        $this->company = $company;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        Mail::to($this->company->email)->send(new WelcomeMail($this->company));
        return 1;
    }
}
