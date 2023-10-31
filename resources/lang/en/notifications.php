<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Notifications Email Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the Notification library to build
    | the Notification emails. You are free to change them to anything
    | you want to customize your views to better match your platform.
    | Supported colors are blue, green, and red.
    |
    */

    // Auth Notifications
    'password_updated' => [
        'subject' => 'Your :marketplace password has bee updated successfully!',
        'greeting' => 'Hello :user!',
        'message' => 'Your account login password has been changed successfully! If you didn\'t make it, please contact us asap! Click the button below to login into your profile page.',
        'button_text' => 'Visit Your Profile',
    ],

    'customer_password_reset' => [
        'subject' => 'REN-ONE Reset Password Notification',
        'greeting' => 'Hello!',
        'message' => 'You are receiving this email because we received a password reset request for your account. If you did not request a password reset, Just ignore this notification and no further action is required.',
        'button_text' => 'Reset Password',
		'thanks' => 'Thank you'
    ],
];