<?php

namespace App\Livewire;

use Livewire\Component;

class ContactForm extends Component
{

    public $name, $number, $email, $message, $captcha = 0;

    public function updatedCaptcha($token)
    {
        $response = \Illuminate\Support\Facades\Http::post('https://www.google.com/recaptcha/api/siteverify?secret=' . env('CAPTCHA_SITE_SECRET') . '&response=' . $token);

        if ($response->json()['success'] == false) {
            session()->flash('success', 'Google thinks you are a bot, please refresh and try again');
        } else {
            $this->captcha = $response->json()['score'];
            if ($this->captcha > .3) {
                // continute saving data
                $this->store();
            } else {
                $this->dispatch('success', message: 'Google thinks you are a bot, please refresh and try again');
            }
        }
    }

    public function store()
    {
        $this->dispatch('success', message: 'Create Successfully');
        session()->flash('success', 'Form submitted');
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
