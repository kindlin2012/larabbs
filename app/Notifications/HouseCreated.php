<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Warehouse;

class HouseCreated extends Notification
{
    use Queueable;
    public $warehouse;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Warehouse $warehouse)
    {
        $this->warehouse=$warehouse;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    public function toDatabase($notifiable)
    {
        $link = route('warehouses.show', $this->warehouse->id);
        // 存入数据库里的数据
        return[
            'user_name' => $this->warehouse->user->name,
            // 'reply_id' => $this->reply->id,
            // 'reply_content' => $this->reply->content,
            'house_name'=> $this->warehouse->housename,
            'house_description'=>$this->warehouse->description,
            'user_id' => $this->warehouse->user->id,
            'user_avatar' => $this->warehouse->user->avatar,
            'house_link' => $link,
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
