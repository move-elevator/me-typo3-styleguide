<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use MoveElevator\Styleguide\Configuration;

defined('TYPO3') || die('Access denied.');

ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'label' => 'LLL:EXT:' . Configuration::EXT_KEY . '/Resources/Private/Language/locallang.xlf:contentelement.technical_headline.label',
        'value' => 'metypo3styleguide_technicalheadline',
        'icon' => 'content-info',
        'description' => 'LLL:EXT:my_extension/Resources/Private/Language/locallang.xlf:contentelement.technical_headline.description',
    ],
    'html',
    'after',
);

$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['metypo3styleguide_technicalheadline'] = 'content-info';

$GLOBALS['TCA']['tt_content']['columns'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['columns'],
    [
        'tx_metypo3styleguide_technicalheadlinetag' => [
            'label' => 'LLL:EXT:' . Configuration::EXT_KEY . '/Resources/Private/Language/locallang.xlf:contentelement.technical_headline.tag',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 'h2',
                'items' => [
                    [
                        'LLL:EXT:' . Configuration::EXT_KEY . '/Resources/Private/Language/locallang.xlf:contentelement.technical_headline.tag.h2',
                        'h2',
                    ],
                    [
                        'LLL:EXT:' . Configuration::EXT_KEY . '/Resources/Private/Language/locallang.xlf:contentelement.technical_headline.tag.h3',
                        'h3',
                    ],
                    [
                        'LLL:EXT:' . Configuration::EXT_KEY . '/Resources/Private/Language/locallang.xlf:contentelement.technical_headline.tag.h4',
                        'h4',
                    ],
                ],
            ],
        ],
    ]
);


$GLOBALS['TCA']['tt_content']['types']['metypo3styleguide_technicalheadline'] = [
    'showitem' => '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                    --palette--;;general,
                    --palette--;;header,tx_metypo3styleguide_technicalheadlinetag,subheader,bodytext,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                    --palette--;;frames,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                    --palette--;;language,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                    --palette--;;hidden,
                    --palette--;;access,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
                    categories,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                    rowDescription,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,',
    'columnsOverrides' => [
        'bodytext' => [
            'config' => [
                'enableRichtext' => true,
                'richtextConfiguration' => 'default',
            ],
        ],
    ],
];
