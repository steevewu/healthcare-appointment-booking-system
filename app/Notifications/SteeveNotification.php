<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Filament\Notifications\Notification;
use Filament\Actions\Action;


class SteeveNotification extends Notification
{
    use Queueable;



    public static function sendSuccessNotification(?string $title = null, ?string $message = null, Action|string|null $action = null): static
    {

        if ($action instanceof Action){
            return static::make()
                ->title($title ?? __('filament::resources.success'))
                ->body($message ?? __('filament::resources.succ_messages', ['action' => $action->getName()]), )
                ->success()
                ->seconds(5)
                ->send();
            
        }
        
        
        return static::make()
            ->title($title ?? __('filament::resources.success'))
            ->body($message ?? __('filament::resources.succ_messages', ['action' => $action ?? '...']), )
            ->success()
            ->seconds(5)
            ->send();
    }



    public static function sendFailedNotification(?string $title = null, ?string $message = null): static
    {
        return static::make()
            ->title($title ?? __('filament::resources.error'))
            ->body(__('filament::resources.err_messages') . "\n" . $message)
            ->danger()
            ->seconds(10)
            ->send();
    }



}
