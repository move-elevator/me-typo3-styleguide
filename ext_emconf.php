<?php

/** @var string $_EXTKEY */
$EM_CONF[$_EXTKEY] = [
    'title' => 'TYPO3 Styleguide',
    'description' => 'This extension provides several tools for a TYPO3 styleguide.',
    'category' => 'module',
    'author' => 'Konrad Michalik',
    'author_email' => 'km@move-elevator.de',
    'author_company' => 'move elevator GmbH',
    'state' => 'stable',
    'version' => '0.1.0',
    'constraints' => [
        'depends' => [
            'php' => '8.1.0-8.99.99',
            'typo3' => '11.0.0-13.99.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
