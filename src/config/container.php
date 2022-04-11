<?php

return [
    'singletons' => [
        \app\services\UserCreateService::class => \app\services\UserCreateService::class,
        \app\services\UserRegistrationNotificationService::class => \app\services\UserRegistrationNotificationService::class,
        \app\services\UserAuthorizationService::class => \app\services\UserAuthorizationService::class,
        \app\services\UserRecoverPasswordService::class => \app\services\UserRecoverPasswordService::class,
        \app\services\UserFindEmailService::class => \app\services\UserFindEmailService::class,
        \app\services\StaffAddService::class => \app\services\StaffAddService::class,
        \app\services\StaffChangeService::class => \app\services\StaffChangeService::class


    ],
];

