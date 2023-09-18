<?php

namespace Component\User\Infrastructure\Mail;

use App\Models\EmailLog;
use Illuminate\Mail\Mailable;

class CustomMail extends Mailable
{
    /**
     * @param array<string,int|string> $data
     */
    public function __construct(readonly array $data)
    {
    }

    /**
     * Build the message.
     */
    public function build(): CustomMail
    {
        $email = $this
            ->subject('Custom Mail')
            ->view('customEmail')
            ->with(['data' => $this->data]);

        $emailLogData = [
            'user_id' => $this->data['user_id'],
            'subject' => 'Custom Mail',
            'sent' => true,
            'sent_at' => now(),
        ];

        if (array_key_exists('value', $this->data)) {
            $emailLogData['message'] = $this->data['value'];
        }

        if (array_key_exists('image', $this->data)) {
            $emailLogData['image_path'] = $this->data['image'];
        }

        /** @phpstan-ignore-next-line */
        EmailLog::create($emailLogData);

        return $email;
    }
}
