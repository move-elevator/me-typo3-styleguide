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

namespace MoveElevator\Styleguide\ViewHelpers\Render;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * This ViewHelper renders a template file with optional variables and paths.
 *
 * Usage:
 * ```html
 * <html
 *   xmlns:sg="http://typo3.org/ns/MoveElevator/Styleguide/ViewHelpers"
 *   data-namespace-typo3-fluid="true"
 * >
 *
 * <sg:render.template file="EXT:myext/Resources/Private/Templates/MyTemplate.html" variables="{myVar: 'value'}" />
 * ```
 */
class TemplateViewHelper extends AbstractViewHelper
{
    /**
     * @var bool
     */
    protected $escapeOutput = false;
    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('file', 'string', 'Path to template file, EXT:myext/... paths supported');
        $this->registerArgument('variables', 'array', 'Optional array of template variables for rendering');
        $this->registerArgument('format', 'string', 'Optional format of the template(s) being rendered');
        $this->registerArgument(
            'paths',
            'array',
            'Optional array of arrays of layout and partial root paths, EXT:mypath/... paths supported'
        );
    }

    public function render(): string
    {
        /** @var string|null $file */
        $file = $this->arguments['file'];
        if ($file === null) {
            /** @var string|null $file */
            $file = $this->renderChildren();
        }

        $file = GeneralUtility::getFileAbsFileName((string)$file);
        $view = static::getPreparedView();
        $view->setRequest(self::resolveRequestFromRenderingContext($this->renderingContext)); // @phpstan-ignore method.deprecatedClass
        $view->setTemplatePathAndFilename($file); // @phpstan-ignore method.deprecatedClass
        if (is_array($this->arguments['variables'])) {
            $view->assignMultiple($this->arguments['variables']);
        }
        /** @var string|null $format */
        $format = $this->arguments['format'];
        if ($format !== null) {
            $view->setFormat($format); // @phpstan-ignore method.deprecatedClass
        }
        $paths = $this->arguments['paths'];
        if (is_array($paths)) {
            if (isset($paths['layoutRootPaths']) && is_array($paths['layoutRootPaths'])) {
                $layoutRootPaths = $this->processPathsArray($paths['layoutRootPaths']);
                $view->setLayoutRootPaths($layoutRootPaths); // @phpstan-ignore method.deprecatedClass
            }
            if (isset($paths['partialRootPaths']) && is_array($paths['partialRootPaths'])) {
                $partialRootPaths = $this->processPathsArray($paths['partialRootPaths']);
                $view->setPartialRootPaths($partialRootPaths); // @phpstan-ignore method.deprecatedClass
            }
        }
        return static::renderView($view, $this->arguments);
    }

    /**
     * @param array $paths
     * @return array
     */
    protected function processPathsArray(array $paths): array
    {
        $pathsArray = [];
        foreach ($paths as $key => $path) {
            $pathsArray[$key] = (str_starts_with($path, 'EXT:')) ? GeneralUtility::getFileAbsFileName($path) : $path;
        }

        return $pathsArray;
    }

    public static function resolveRequestFromRenderingContext(RenderingContextInterface $renderingContext): object
    {
        $request = null;
        if (method_exists($renderingContext, 'getRequest')) {
            $request = $renderingContext->getRequest();
        } elseif (method_exists($renderingContext, 'getControllerContext')) {
            $request = $renderingContext->getControllerContext()->getRequest();
        }
        if (!$request) {
            throw new \UnexpectedValueException('Unable to resolve request from RenderingContext', 1673191812);
        }
        return $request;
    }

    protected static function renderView(StandaloneView $view, array $arguments): string //@phpstan-ignore parameter.deprecatedClass
    {
        try {
            /** @var string|null $content */
            $content = $view->render();
        } catch (\Exception $error) {
            if (!($arguments['graceful'] ?? false)) {
                throw $error;
            }
            $content = $error->getMessage() . ' (' . $error->getCode() . ')';
        }
        return (string)$content;
    }

    protected static function getPreparedView(): StandaloneView //@phpstan-ignore return.deprecatedClass
    {
        /** @var StandaloneView $view */
        $view = GeneralUtility::makeInstance(StandaloneView::class); //@phpstan-ignore classConstant.deprecatedClass
        return $view;
    }
}
