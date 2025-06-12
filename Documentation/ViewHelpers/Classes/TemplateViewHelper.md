# TemplateViewHelper

This ViewHelper renders a template file with optional variables and paths.

Usage:
```html
<html
  xmlns:sg="http://typo3.org/ns/MoveElevator/Styleguide/ViewHelpers"
  data-namespace-typo3-fluid="true"
>

<sg:render.template file="EXT:myext/Resources/Private/Templates/MyTemplate.html" variables="{myVar: 'value'}" />
```

