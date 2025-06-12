<?php

namespace MoveElevator\Styleguide\ViewHelpers\Format;

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * This ViewHelper removes the file ending from a filename.
 *
 * Usages:
 * ```html
 * <html
 *   xmlns:sg="http://typo3.org/ns/MoveElevator/Styleguide/ViewHelpers"
 *   data-namespace-typo3-fluid="true"
 * >
 * <sg:format.filename>logo.svg</xt3:format.filename>
 *
 * {value -> sg:format.filename()}
 * ```
 *
 * Result:
 * ```
 * logo
 * ```
 */
class FilenameViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument('filename', 'string', 'String to format');
    }

    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext): string
    {
        $value = $renderChildrenClosure();
        return pathinfo($value, PATHINFO_FILENAME);
    }
}
