# Description

This repository adds a task for GrumPHP that launchs drupal-check.
During a commit if drupal-check finds code that will be deprecated in drupal 9 GrumPHP won't let the commit happen.


# Installation

Install it using composer:

```composer require metadrop/grumphp-drupal-check```


# Usage

1) Add the extension in your grumphp.yml file:
```yaml
extensions:
  - GrumphpDrupalCheck\ExtensionLoader
```

2) Add drupal check to the tasks:
```
tasks:
  drupalcheck: ~
```

