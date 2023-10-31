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
        'subject' => 'Ihr :marketplace Passwort wurde erfolgreich aktualisiert!',
        'greeting' => 'Hallo :user!',
        'message' => 'Ihr Passwort wurde erfolgreich geändert! Wenn Sie es nicht initiiert haben, nehmen Sie bitte umgehend Kontakt mit uns auf! Klicken Sie auf die Schaltfläche unten, um sich auf Ihrer Profilseite anzumelden.',
        'button_text' => 'Gehen Sie zu Ihrem Profil',
    ],

    'customer_password_reset' => [
        'subject' => 'REN-ONE Passwort zurücksetzen',
        'greeting' => 'Hallo!',
        'message' => 'Sie erhalten diese E-Mail, weil wir eine Anfrage zum Zurücksetzen des Passworts für Ihr Konto erhalten haben. Wenn Sie kein Zurücksetzen des Passworts angefordert haben, ignorieren Sie diese Benachrichtigung einfach, es sind keine weiteren Maßnahmen erforderlich.',
        'button_text' => 'Passwort zurücksetzen',
		'thanks' => 'Danke'
    ],
];