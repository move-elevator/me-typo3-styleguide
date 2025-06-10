<?php

namespace MoveElevator\Styleguide\ViewHelpers;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

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
            throw new \InvalidArgumentException('The provided path is not a valid directory: ' . $path);
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
