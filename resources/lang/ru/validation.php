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

    'accepted' => ':attribute должно быть принят.',
    'active_url' => ':attribute содержит неверный URL.',
    'after' => ':attribute может быть датой после :date.',
    'after_or_equal' => ':attribute может быть датой после или равной :date.',
    'alpha' => ':attribute может содержать только буквы.',
    'alpha_dash' => ':attribute может содержать только буквы, цифры, дефис и нижний дефис.',
    'alpha_num' => ':attribute может содержать только буквы и цифры.',
    'array' => ':attribute может быть только массивом.',
    'before' => ':attribute может быть датой перед :date.',
    'before_or_equal' => ':attribute может быть датой перед или равной :date.',
    'between' => [
        'numeric' => ':attribute может быть между :min и :max.',
        'file' => ':attribute может быть между :min и :max килобайт.',
        'string' => ':attribute может быть между :min и :max символов.',
        'array' => ':attribute может быть между :min и :max элементов.',
    ],
    'boolean' => ':attribute поле может быть true или false.',
    'confirmed' => ':attribute подтверждение не совпадает.',
    'date' => ':attribute содержит неверную дату.',
    'date_equals' => ':attribute может быть датой равной :date.',
    'date_format' => ':attribute не соответствует формату :format.',
    'different' => ':attribute и :other должны быть разными.',
    'digits' => ':attribute может быть :digits числами.',
    'digits_between' => ':attribute может быть между :min и :max числами.',
    'dimensions' => ':attribute имеет недопустимый размер изображения.',
    'distinct' => ':attribute поле дублирует значение.',
    'email' => ':attribute должно быть верным email адресом.',
    'ends_with' => ':attribute должно быть одним из следующих: :values.',
    'exists' => 'Выделенным :attribute неверен.',
    'file' => ':attribute должно быть файлом.',
    'filled' => ':attribute должно иметь значение.',
    'gt' => [
        'numeric' => ':attribute должно быть больше, чем :value.',
        'file' => ':attribute должно быть больше, чем :value килобайт.',
        'string' => ':attribute должно быть больше, чем :value символов.',
        'array' => ':attribute должно быть больше, чем :value элементов.',
    ],
    'gte' => [
        'numeric' => ':attribute должно быть больше или равен :value.',
        'file' => ':attribute должно быть больше или равен :value килобайт.',
        'string' => ':attribute должно быть больше или равен :value символов.',
        'array' => ':attribute должно иметь :value элементов или более.',
    ],
    'image' => ':attribute должно быть изображением.',
    'in' => 'Выделенный :attribute неверен.',
    'in_array' => ':attribute поле не существует в :other.',
    'integer' => ':attribute должно быть числом.',
    'ip' => ':attribute должно быть верным IP адресом.',
    'ipv4' => ':attribute должно быть верным IPv4 адресом.',
    'ipv6' => ':attribute должно быть верным IPv6 адресом.',
    'json' => ':attribute должно быть верной JSON строкой.',
    'lt' => [
        'numeric' => ':attribute должно быть меньше, чем :value.',
        'file' => ':attribute должно быть меньше, чем :value килобайт.',
        'string' => ':attribute должно быть меньше, чем :value символов.',
        'array' => ':attribute должно иметь меньше, чем :value элементов.',
    ],
    'lte' => [
        'numeric' => ':attribute должно быть меньше или равно :value.',
        'file' => ':attribute должно быть меньше или равно :value килобайт.',
        'string' => ':attribute должно быть меньше или равно :value символов.',
        'array' => ':attribute должно иметь не менее :value элементов.',
    ],
    'max' => [
        'numeric' => ':attribute не должно быть больше, чем :max.',
        'file' => ':attribute не должно быть больше, чем :max килобайт.',
        'string' => ':attribute не должно быть больше, чем :max элементов.',
        'array' => ':attribute не должно иметь больше, чем :max элементов.',
    ],
    'mimes' => ':attribute должно иметь тип файла: :values.',
    'mimetypes' => ':attribute должно иметь тип файла: :values.',
    'min' => [
        'numeric' => ':attribute должно быть как минимум :min.',
        'file' => ':attribute должно быть как минимум :min килобайт.',
        'string' => ':attribute должно быть как минимум :min элементов.',
        'array' => ':attribute должно иметь как минимум :min элементов.',
    ],
    'multiple_of' => ':attribute можеть быть в диапозоне :value.',
    'not_in' => 'Выделенный :attribute неверен.',
    'not_regex' => ':attribute формат неверен.',
    'numeric' => ':attribute должно быть номером.',
    'password' => 'Пароль неверен.',
    'present' => ':attribute поле должно присутствовать.',
    'regex' => ':attribute формат неверен.',
    'required' => ':attribute поле должно быть обязательным.',
    'required_if' => ':attribute поле обязательно, когда :other является :value.',
    'required_unless' => ':attribute поле обязательно, кроме :other присутствующем в :values.',
    'required_with' => ':attribute поле обязательно, когда :values присутствует.',
    'required_with_all' => ':attribute поле обязательно, когда :values присутствуют.',
    'required_without' => ':attribute поле обязательно, когда :values не присутствует.',
    'required_without_all' => ':attribute поле обязательно, когда ни один из :values не присутствуют.',
    'same' => ':attribute и :other не совпадают.',
    'size' => [
        'numeric' => ':attribute должен быть :size.',
        'file' => ':attribute должен быть :size килобайт.',
        'string' => ':attribute должен быть :size символов.',
        'array' => ':attribute должно содержать :size элементов.',
    ],
    'starts_with' => ':attribute должно начинаться с одного из: :values.',
    'string' => ':attribute должно быть строкой.',
    'timezone' => ':attribute должно быть верной зоной.',
    'unique' => ':attribute уже существует.',
    'uploaded' => ':attribute не вышло загрузить.',
    'url' => ':attribute формат неверен.',
    'uuid' => ':attribute должно быть верным UUID.',

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
        ':attribute-name' => [
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

    ':attributes' => [],

];
