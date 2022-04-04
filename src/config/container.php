<?php

return [
    'singletons' => [
        \app\services\UserCreateService::class => \app\services\UserCreateService::class,
        \app\services\UserRegistrationNotificationService::class => \app\services\UserRegistrationNotificationService::class,
        \app\services\UserAuthorizationService::class => \app\services\UserAuthorizationService::class,
    ],
];