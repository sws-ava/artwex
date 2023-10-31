<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

'accepted' => 'The :attribute muss akzeptiert werden.',
    'active_url' => 'bei :attribute handelt es sich um keine gültige URL.',
    'after' => ':attribute muss ein späteres Datum aufweisen als :date.',
    'after_or_equal' => ':attribute muss aktuelles oder späteres Datum aufweisen als :date.',
    'alpha' => ':attribute darf nur Buchstaben enthalten.',
    'alpha_dash' => ':attribute darf nur Buchstaben, Zahlen, Bindestriche und Unterstriche enthalten.',
    'alpha_num' => ':attribute darf nur Buchstaben und Zahlen enthalten.',
    'array' => ':attribute must be an array.',
    'before' => ':attribute muss ein früheres Datum aufweisen als :date.',
    'before_or_equal' => ':attribute muss ein früheres oder gleiches Datum aufweisen als :date.',
    'between' => [
        'numeric' => ':attribute darf den Wert zwischen :min and :max aufweisen.',
        'file' => ':attribute darf zwischen :min und :max kilobytes groß sein.',
        'string' => ':attribute darf zwischen :min and :max Zeichen beinhalten.',
        'array' => ':attribute muss zwischen :min and :max Elemente beinhalten.',
    ],
    'boolean' => ':attribute Das Feld muss die Werte Wahr oder Falsch beinhalten.',
    'confirmed' => ':attribute Bestätigung stimmt nicht überein.',
    'date' => 'The :attribute ist kein gültiges Datum.',
    'date_equals' => ':attribute muss gleich sein mit Datum :date.',
    'date_format' => ':attribute stimmt nicht mit dem :format überein.',
    'different' => ':attribute und :other dürfen nicht übereinstimmen.',
    'digits' => ':attribute muss :digits Zahlen beinhalten.',
    'digits_between' => ':attribute muss zwischen :min and :max Zahlen beinhalten.',
    'dimensions' => 'The :attribute hat ungültige Bildabmessungen.',
    'distinct' => ':attribute im Feld wiederholt sich.',
    'email' => ':attribute hier muss eine gültige Email Adresse eingeführt werden.',
    'ends_with' => ':attribute muss mit einem der folgenden Werten enden: :values',
    'exists' => 'Ausgewählte :attribute ist ungültig.',
    'file' => ':attribute muss eine Datei beinhalten.',
    'filled' => ':attribute In das Feld muss ein Wert eingetragen werden.',
    'gt' => [
        'numeric' => ':attribute Wert muss größer sein als :value.',
        'file' => ':attribute Datei muss größer sein als :value kilobytes.',
        'string' => ':attribute Wert muss größer sein als :value characters.',
        'array' => ':attribute Wert muss mehr als :value Zeichen beinhalten.',
    ],
    'gte' => [
        'numeric' => ':attribute Wert muss grösser oder gleich sein als :value.',
        'file' => ':attribute Wert muss größer oder gleich sein als :value kilobytes.',
        'string' => ':attribute Wert darf nicht weniger Zeichen als :value beinhalten.',
        'array' => 'The :attribute Wert muss mehr als :value Produkte beinhalten.',
    ],
    'image' => ':attribute muss ein Bild sein.',
    'in' => 'Ausgewählt :attribute ungültige  Datei.',
    'in_array' => ':attribute Das Feld existiert nicht in :other.',
    'integer' => ':attribute muss eine ganze Zahl sein',
    'ip' => ':attribute muss eine gültige IP Adresse haben.',
    'ipv4' => ':attribute muss eine gültige IPv4 Adresse haben.',
    'ipv6' => ':attribute muss eine gültige IPv6 Adresse haben.',
    'json' => ':attribute muss eine gültige JSON-Zeichenfolge haben.',
    'lt' => [
        'numeric' => ':attribute muss kleiner sein als :value.',
        'file' => ':attribute muss kleiner sein als :value kilobytes.',
        'string' => ':attribute muss weniger Zeichen haben als :value.',
        'array' => ':attribute muss weniger Produkte beinhalten als :value.',
    ],
    'lte' => [
        'numeric' => ':attribute Wert muss gleich oder kleiner sein als  :value.',
        'file' => ':attribute Wert muss gleich oder kleiner sein als :value kilobytes.',
        'string' => ':attribute Wert muss darf gleich oder weniger Zeichen beinhalten als:value.',
        'array' => ':attribute darf nicht mehr Produkte beinhalten als  :value.',
    ],
    'max' => [
        'numeric' => ':attribute darf nicht größer sein als :max.',
        'file' => ':attribute darf nicht größer sein als:max kilobytes.',
        'string' => ':attribute darf nicht mehr Zeichen beinhalten als :max.',
        'array' => ':attribute darf nicht mehr Produkte beinhalten als :max.',
    ],
    'mimes' => ':attribute muss eine Datei sein vom Typ: :values.',
    'mimetypes' => ':attribute muss eine Datei vom Typ sein :values.',
    'min' => [
        'numeric' => ':attribute muss mindestens :min sein.',
        'file' => ':attribute muss mindestens :min kilobytes sein.',
        'string' => ':attribute muss mindestens :min zeichen beinhalten.',
        'array' => ':attribute muss mindestens :min Produkte beinhalten.',
    ],
    'not_in' => 'Die ausgewählte :attribute ist ungültig.',
    'not_regex' => ':attribute Format ist ungültig.',
    'numeric' => ':attribute  muss aus Zahlen bestehen.',
    'present' => ':attribute Feld muss vorhanden sein.',
    'regex' => ':attribute Format ist ungültig.',
    'required' => ':attribute Feld ist erforderlich.',
    'required_if' => ':attribute Feld ist erforderlich, wenn :other ist :value.',
    'required_unless' => ':attribute Feld ist erforderlich Außer :other ist in :values.',
    'required_with' => ':attribute Feld ist notwendig, wenn :values vorhanden ist.',
    'required_with_all' => ': Feld ist notwendig, wenn :values vorhanden ist.',
    'required_without' => ':attribute Feld ist notwendig, wenn :values nicht vorhanden ist.',
    'required_without_all' => ':attribute Feld ist notwendig, wenn keine :values vorhanden sind.',
    'same' => ':attribute und :other müssen zusammenpassen.',
    'size' => [
        'numeric' => ':attribute muss sein :size.',
        'file' => ':attribute muss :size kilobytes sein.',
        'string' => ':attribute muss :size Zeichen beinhalten.',
        'array' => ':attribute muss :size Produkte beinhalten.',
    ],
    'starts_with' => ':attribute muss mit folgendem Werten beginnen :values',
    'string' => ':attribute muss eine Zeichenfolge sein.',
    'timezone' => ':attribute muss einen gültigen Wert haben.',
    'unique' => ':attribute wird bereits verwendet.',
    'uploaded' => ':attribute Fehler beim Hochladen.',
    'url' => ':attribute Ungültiges Format.',
    'uuid' => ':attribute muss UUID entsprechen.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
