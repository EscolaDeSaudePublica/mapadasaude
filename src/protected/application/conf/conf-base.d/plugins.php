<?php

return [
    'plugins' => [
        'EvaluationMethodTechnical' => ['namespace' => 'EvaluationMethodTechnical', 'config' => ['step' => 0.1]],
        'EvaluationMethodSimple' => ['namespace' => 'EvaluationMethodSimple'],
        'EvaluationMethodDocumentary' => ['namespace' => 'EvaluationMethodDocumentary'],
        //PLUGIN DESENVOLVIDO PELA ESP
        'LocationStateCity' => [
            'namespace' => 'LocationStateCity'
        ],
        'PDFReport' => [
            'namespace' => 'PDFReport'
        ],
        'SealModelTab' => ['namespace' => 'SealModelTab' ],
        'SealCertified' => [ 
            'namespace' => 'SealCertified', 
            'config' => [ 
                'logo-site' => 'img/logo-saude.png' 
            ] 
        ],
    ]
];