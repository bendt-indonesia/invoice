<?php
return [
    'due_days' => 14, //default invoice due date
    'invoice_no' => 'BBB-INV/YY-MM/',   //BBB = Branch Code
    'receipt_no' => 'BBB-BR/YY-MM/',
    'giro_receipt_no' => 'BBB-GR/YY-MM/',
    'va_receipt_no' => 'BBB-VA/YY-MM/',
    'class' => [
        'customer' => \App\Models\Customer::class,
        'option' => \App\Models\Option::class,
        'user' => \App\User::class,
    ],
];
