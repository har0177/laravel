<?php

namespace App\Livewire;

use App\Models\Employee;
use App\Models\Student;
use App\Services\SmsService;
use Livewire\Component;

class SMS extends Component
{

    public $sms = null;
    public $type = null;

    public function render()
    {
        return view('livewire.sms');
    }

    public function sendSMS()
    {

        if (empty($this->type)) {
            $this->addError('type', "Please select Type");
            return;
        }

        if (empty($this->sms)) {
            $this->addError('sms', "Please enter Message");
            return;
        }


        $recipients = [];

        if ($this->type === 'student') {
            $recipients = Student::query()->where('status', 'Active')->get()
                ->pluck('user.phone');
        } elseif ($this->type === 'employee') {
            $recipients = Employee::query()->where('status', 1)->pluck('contact_number');
        } elseif ($this->type === 'parents') {
            $recipients = Student::query()->where('status', 'Active')->pluck('father_contact');
        }

        $recipients = $recipients
            ->map(fn($value) => trim($value))
            ->filter(fn($value) => is_numeric($value) && $value !== '')
            ->map(fn($value) => str_replace('"', '', $value))
            ->map(function ($value) {
                $phone = ltrim($value, '0');
                if (substr($phone, 0, 2) !== '92') {
                    $phone = '92' . $phone;
                }
                return str_replace('-', '', $phone);
            })
            ->values()
            ->toArray();

        $cleanedRecipients = implode(',', $recipients);

        $sms = new SmsService();
        $sms->sendToAll($cleanedRecipients, $this->sms);

        session()->flash('success', "SMS Send Successfully to " . $cleanedRecipients);

        $this->reset(['type', 'sms']);
    }
}
