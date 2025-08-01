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

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * This ViewHelper generates a contrast color based on a given color.
 *
 * Usage:
 * ```html
 *
 * <html
 *   xmlns:sg="http://typo3.org/ns/MoveElevator/Styleguide/ViewHelpers"
 *   data-namespace-typo3-fluid="true"
 * >
 * <sg:contrastColor color="#ff5733" />
 *
 * ```
 */
class ContrastColorViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument('color', 'string', 'HEX Code', true);
    }

    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext): string
    {
        $hexColor = ltrim($arguments['color'], '#');
        if (strlen($hexColor) !== 6) {
            throw new \InvalidArgumentException('Invalid HEX color code: ' . $arguments['color'], 4518636088);
        }

        $r = hexdec(substr($hexColor, 0, 2));
        $g = hexdec(substr($hexColor, 2, 2));
        $b = hexdec(substr($hexColor, 4, 2));

        $brightness = ($r * 0.299 + $g * 0.587 + $b * 0.114);

        return $brightness > 128 ? '#000000' : '#FFFFFF';
    }
}
