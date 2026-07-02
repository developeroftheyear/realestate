<?php

namespace App\Notifications;

use App\Models\ContactMessage;
use App\Models\ContactMessageReply;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class InquiryReplyNotification extends Notification
{
    use Queueable;

    public function __construct(
        public ContactMessage $contactMessage,
        public ContactMessageReply $reply
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'contact_message_id' => $this->contactMessage->id,
            'reply_id' => $this->reply->id,
            'subject' => $this->contactMessage->subject,
            'preview' => \Illuminate\Support\Str::limit($this->reply->body, 120),
            'admin_name' => $this->reply->admin->name,
        ];
    }
}
