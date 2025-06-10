<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use MoveElevator\Styleguide\Configuration;

defined('TYPO3') || die('Access denied.');

ExtensionManagementUtility::addStaticFile(
    Configuration::EXT_KEY,
    'Configuration/TypoScript',
    'TYPO3 Styleguide'
);
