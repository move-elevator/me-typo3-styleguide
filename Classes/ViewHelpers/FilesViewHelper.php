<?php

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

namespace MoveElevator\Styleguide\ViewHelpers;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * This ViewHelper generates a list of files in a specified directory.
 *
 * Usage:
 * ```html
 *
 * <html
 *   xmlns:sg="http://typo3.org/ns/MoveElevator/Styleguide/ViewHelpers"
 *   data-namespace-typo3-fluid="true"
 * >
 *
 * <f:for each="{sg:files(path: path)}" as="file">
 *     {file}
 * </f:for>
 *
 * ```
 */
class FilesViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument('path', 'string', 'Path to the directory to list files from', true);
    }

    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext): array
    {
        $path = GeneralUtility::getFileAbsFileName($arguments['path']);
        if (!is_dir($path)) {
            throw new \InvalidArgumentException('The provided path is not a valid directory: ' . $path, 4247501749);
        }

        $files = [];
        foreach (scandir($path) as $file) {
            if ($file !== '.' && $file !== '..' && is_file($path . '/' . $file)) {
                $files[] = $file;
            }
        }

        return $files;
    }
}
