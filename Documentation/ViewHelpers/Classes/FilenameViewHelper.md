# FilenameViewHelper

This ViewHelper removes the file ending from a filename.

Usages:
```html
<html
  xmlns:sg="http://typo3.org/ns/MoveElevator/Styleguide/ViewHelpers"
  data-namespace-typo3-fluid="true"
>
<sg:formatFilename>logo.svg</xt3:formatFilename>

{value -> sg:formatFilename()}
```

Result:
```
logo
```

