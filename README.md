<div align="center">

![Extension icon](Resources/Public/Icons/Extension.svg)

# TYPO3 extension `typo3_styleguide`

[![Latest Stable Version](https://typo3-badges.dev/badge/typo3_styleguide/version/shields.svg)](https://extensions.typo3.org/extension/typo3_styleguide)
[![Supported TYPO3 versions](https://badgen.net/badge/TYPO3/12%20&%2013/orange)]()
[![CGL](https://img.shields.io/github/actions/workflow/status/move-elevator/typo3-styleguide/cgl.yml?label=cgl&logo=github)](https://github.com/move-elevator/typo3-styleguide/actions/workflows/cgl.yml)
[![License](https://poser.pugx.org/move-elevator/typo3-styleguide/license)](LICENSE.md)

</div>

This extension provides several tools for a simple TYPO3 based styleguide.

> [!NOTE]
> This extension is more of a best practice for implementing and maintaining an editorial style guide in TYPO3 with small reusable helpers.

## ✨ Features

* Content element for technical headlines with automatic table of contents
* Static templates for rendering any templates or partials
* Predefined template patterns for images, icons, colors and fonts
* Collection of TYPO3 ViewHelpers for reuse in templates

## 🔥 Installation

### Requirements

* TYPO3 >= 11.5
* PHP 8.1+

Install via composer:

### Composer

[![Packagist](https://img.shields.io/packagist/v/move-elevator/typo3-styleguide?label=version&logo=packagist)](https://packagist.org/packages/move-elevator/typo3-styleguide)
![Packagist Downloads](https://img.shields.io/packagist/dt/move-elevator/typo3-styleguide?color=brightgreen)

``` bash
composer require move-elevator/typo3-styleguide
```

### TER

ToDo

### Setup

Include static TypoScript template via the backend or import it:

```
@import 'EXT:typo3_styleguide/Configuration/TypoScript/setup.typoscript'
```

## 📙 Documentation

- [Content Element](Documentation/ContentElement.md)
- [Static Templates](Documentation/StaticTemplates.md)
- [Patterns](Documentation/Patterns.md)
- [ViewHelpers](Documentation/ViewHelpers/CLASSES.md)


## 🧑‍💻 Contributing

Please have a look at [`CONTRIBUTING.md`](CONTRIBUTING.md).

## 💎 Credits

Style by Adrien Coquet from <a href="https://thenounproject.com/browse/icons/term/style/" target="_blank" title="style Icons">Noun Project</a> (CC BY 3.0).

## ⭐ License

This project is licensed
under [GNU General Public License 2.0 (or later)](LICENSE.md).
