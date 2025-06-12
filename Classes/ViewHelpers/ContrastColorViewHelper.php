<?php

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
            throw new \InvalidArgumentException('Invalid HEX color code: ' . $arguments['color']);
        }

        $r = hexdec(substr($hexColor, 0, 2));
        $g = hexdec(substr($hexColor, 2, 2));
        $b = hexdec(substr($hexColor, 4, 2));

        $brightness = ($r * 0.299 + $g * 0.587 + $b * 0.114);

        return $brightness > 128 ? '#000000' : '#FFFFFF';
    }
}
