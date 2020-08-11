# Description

This repository adds a task for GrumPHP that launchs [drupal-check](https://github.com/mglaman/drupal-check).
During a commit check Drupal code for deprecations and discover bugs via static analysis. If a deprecated code is detected, it won't pass.


# Installation

Install it using composer:

```composer require --dev metadrop/grumphp-drupal-check```


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

