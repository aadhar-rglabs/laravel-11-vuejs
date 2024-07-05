<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The company instance.
     *
     * @var Company
     */
    public $company;

    public $action_url;
    public $login_url;
    public $trial_length;
    public $trial_start_date;
    public $trial_end_date;
    public $support_email;
    public $live_chat_url;
    public $help_url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Company $company)
    {
        $this->company = $company;
        $this->action_url = "javascript:void(0);";
        $this->login_url = "javascript:void(0);";
        $this->live_chat_url = "javascript:void(0);";
        $this->help_url = "javascript:void(0);";
        $this->trial_length = "7";
        $this->trial_start_date = "05/07/2024";
        $this->trial_end_date = "12/07/2024";
        $this->support_email = "12/07/2024";
        // $this->action_url = URL::temporarySignedRoute('evoplay.reset-password', now()->addHours(24), ['q' => base64_encode($user->id)]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.welcome')
            ->with([
                'name' => $this->company->name,
                'email' => $this->company->email,
                // 'action_url' => $this->action_url,
            ]);
    }
}
