<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MeetingSet extends Notification implements ShouldQueue
{
    protected $arr;
    use Queueable;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(array $arr)
    {
        $this->arr = $arr;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if ($this->arr['meeting_form'] == 'other'){
            return (new MailMessage)
                ->line('Your project supervisor scheduled a new meeting for ' .$this->arr['date'])
                ->action('See your project for more details', url('http://127.0.0.1:8000'.$this->arr['link']))
                ->line('Thank you for using our application!');
        } else{
            return (new MailMessage)
                ->line('Your project supervisor scheduled a '.$this->arr['meeting_form'] .' meeting for ' .$this->arr['date'])
                ->action('See your project for more details', url('http://127.0.0.1:8000'.$this->arr['link']))
                ->line('Thank you for using our application!');
        }

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
