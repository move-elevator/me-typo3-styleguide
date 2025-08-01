# FilesViewHelper

This ViewHelper generates a list of files in a specified directory.

Usage:
```html

<html
  xmlns:sg="http://typo3.org/ns/MoveElevator/Styleguide/ViewHelpers"
  data-namespace-typo3-fluid="true"
>

<f:for each="{sg:files(path: path)}" as="file">
    {file}
</f:for>

```
