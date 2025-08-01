# Pattern

The predefined patterns are useful templates within a standard styleguide. These are mainly simple fluid templates which can be configured using the `Static templates` content element.

The following patterns are available:

- [Images](#images)
- [Icons](#icons)
- [Colors](#colors)
- [Font](#font)

## Images

This pattern provides a simple image template that can be used to display images, e.g. logos consistently.

![pattern-image.jpg](Documentation/Images/pattern-image.jpg)

*Frontend template*: `EXT:typo3_styleguide/Resources/Private/Templates/Patterns/Images.html`

Example data:
```json
{
  "images": [
    {
      "path": "EXT:example/Resources/Public/Images/logo.svg",
      "caption": "home"
    }
  ]
}
```

## Icons

This pattern provides a simple icon template that can be used to display all icons/images within a provided path.

![pattern-icons.jpg](Documentation/Images/pattern-icons.jpg)

*Frontend template*: `EXT:typo3_styleguide/Resources/Private/Templates/Patterns/Icons.html`

Example data:
```json
{
    "path": "EXT:example/Resources/Public/Icons/"
}
```

## Colors

This pattern provides a simple color template that can be used to display colors consistently, e.g. for a color palette.

![pattern-colors.jpg](Documentation/Images/pattern-colors.jpg)

*Frontend template*: `EXT:typo3_styleguide/Resources/Private/Templates/Patterns/Colors.html`

Example data:
```json
{
    "colors": [
        {
            "color": "#EAE7E2",
            "label": "cararra"
        },
        {
            "color": "#002337",
            "label": "daintree"
        }
    ]
}
```

## Font

This pattern provides a simple font template that can be used to display available fonts consistently, e.g. for a typography styleguide.

![pattern-font.jpg](Documentation/Images/pattern-font.jpg)

*Frontend template*: `EXT:typo3_styleguide/Resources/Private/Templates/Patterns/Fonts.html`

Example data:
```json
{
    "fonts": [
        {
            "font": "Lexend"
        },
        {
            "font": "Lexend",
            "fontWeight": 700,
            "label": "Lexend 700"
        }
    ]
}
```
