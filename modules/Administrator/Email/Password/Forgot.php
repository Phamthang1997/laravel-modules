<?php

namespace Modules\Administrator\Email\Password;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class Forgot extends ResetPassword
{

    /**
     * Get the reset URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    protected function resetUrl($notifiable): string
    {
        if (static::$createUrlCallback) {
            return call_user_func(static::$createUrlCallback, $notifiable, $this->token);
        }

        return url(route('management.password.token', [ /** @phpstan-ignore-line */
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(), /** @phpstan-ignore-line */
        ], false));
    }

    /**
     * Get the reset password notification mail message for the given URL.
     *
     * @param  string  $url
     * @return MailMessage
     */
    protected function buildMailMessage($url): MailMessage
    {
        return (new MailMessage)
            ->subject(__('administrator::commons.reset_password')) /** @phpstan-ignore-line */
            ->view('administrator::email.password.forgot', compact('url'));
    }
}
