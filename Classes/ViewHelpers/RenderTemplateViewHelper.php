<?php
namespace MoveElevator\Styleguide\ViewHelpers;

/*
 * This file is part of the FluidTYPO3/Vhs project under GPLv2 or later.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class RenderTemplateViewHelper extends AbstractViewHelper
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
        if (null === $file) {
            /** @var string|null $file */
            $file = $this->renderChildren();
        }

        $file = GeneralUtility::getFileAbsFileName((string) $file);
        $view = static::getPreparedView();
        if (method_exists($view, 'setRequest')) {
            $view->setRequest(self::resolveRequestFromRenderingContext($this->renderingContext));
        }
        $view->setTemplatePathAndFilename($file);
        if (is_array($this->arguments['variables'])) {
            $view->assignMultiple($this->arguments['variables']);
        }
        /** @var string|null $format */
        $format = $this->arguments['format'];
        if (null !== $format) {
            $view->setFormat($format);
        }
        $paths = $this->arguments['paths'];
        if (is_array($paths)) {
            if (isset($paths['layoutRootPaths']) && is_array($paths['layoutRootPaths'])) {
                $layoutRootPaths = $this->processPathsArray($paths['layoutRootPaths']);
                $view->setLayoutRootPaths($layoutRootPaths);
            }
            if (isset($paths['partialRootPaths']) && is_array($paths['partialRootPaths'])) {
                $partialRootPaths = $this->processPathsArray($paths['partialRootPaths']);
                $view->setPartialRootPaths($partialRootPaths);
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
            $pathsArray[$key] = (0 === strpos($path, 'EXT:')) ? GeneralUtility::getFileAbsFileName($path) : $path;
        }

        return $pathsArray;
    }

    public static function resolveRequestFromRenderingContext(RenderingContextInterface $renderingContext)
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

    /**
     * @param \TYPO3\CMS\Extbase\Mvc\View\ViewInterface|ViewInterface $view
     */
    protected static function renderView($view, array $arguments): string
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
        return (string) $content;
    }

    protected static function getPreparedView(): StandaloneView
    {
        /** @var StandaloneView $view */
        $view = GeneralUtility::makeInstance(StandaloneView::class);
        return $view;
    }
}
