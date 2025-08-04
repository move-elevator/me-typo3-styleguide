<?php

declare(strict_types=1);

/*
 * This file is part of the TYPO3 CMS extension "typo3_styleguide".
 *
 * Copyright (C) 2025 move elevator GmbH <km@move-elevator.de>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 */

use MoveElevator\Styleguide\Configuration;
use TYPO3\CMS\Core\Domain\Repository\PageRepository;
use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') || die('Access denied.');

ExtensionManagementUtility::addTcaSelectItem(
    'pages',
    'doktype',
    [
        'LLL:EXT:' . Configuration::EXT_KEY . '/Resources/Private/Language/locallang.xlf:page.styleguide',
        Configuration::PAGE_TYPE,
        'apps-pagetree-page-styleguide',
    ],
    '1',
    'after'
);

ArrayUtility::mergeRecursiveWithOverrule(
    $GLOBALS['TCA']['pages'],
    [
        'ctrl' => [
            'typeicon_classes' => [
                Configuration::PAGE_TYPE => 'apps-pagetree-page-styleguide',
                Configuration::PAGE_TYPE . '-contentFromPid' => 'apps-pagetree-page-styleguide',
                Configuration::PAGE_TYPE . '-root' => 'apps-pagetree-page-styleguide',
                Configuration::PAGE_TYPE . '-hideinmenu' => 'apps-pagetree-page-styleguide-hideinmenu',
            ],
        ],
        'types' => [
            Configuration::PAGE_TYPE => [
                'showitem' => $GLOBALS['TCA']['pages']['types'][PageRepository::DOKTYPE_DEFAULT]['showitem'],
            ],
        ],
    ]
);
