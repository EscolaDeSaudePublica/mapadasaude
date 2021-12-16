<?php

return [
    // MAIN

    // 'auth.provider' => 'Fake',
    // 'auth.config' => [],

    // LOG
    'slim.log.level'        => \Slim\Log::EMERGENCY,
    'slim.log.enabled'      => false,

    // 'app.log.query'         => true,
       'app.log.hook'          => false,
    // 'app.log.requestData'   => true,
    // 'app.log.translations'  => true,
    // 'app.log.apiCache'      => true,
    // 'app.log.apiDql'        => true,
    // 'app.log.assets'        => true,

    // CACHE
    // 'app.useRegisteredAutoloadCache' => false,
    'app.useAssetsUrlCache'          => false,
    // 'app.useFileUrlCache'            => false,
    // 'app.useEventsCache'             => false,
    // 'app.useSubsiteIdsCache'         => false,
    // 'app.usePermissionsCache'        => false,
    // 'app.useRegisterCache'           => false,
    // 'app.useApiCache'                => false,

    // CEP
    'cep.token' => '',

    // SELOS
    // 'app.verifiedSealsIds' => 1,
];