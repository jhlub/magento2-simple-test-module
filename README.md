# Magento 2 Simple Module

Module should be placed in `app/code` directory of a Magento installation, with this format: `app/code/<Vendor>/<ModuleName>`.

## Installation guide

- Step 1: Create a directory for the module like above format.
- Step 2: Enable the module.

### Step 1. Create a directory for the module like above format

For Vendor set `TestTask` and for ModuleName set `SimpleTest`. So full path will be:
`app/code/TestTask/SimpleTest`

### Step 2. Enable the module

Before enable the module, check if Magento has recognize this module:

```bash
php bin/magento module:status
```

If this module is listed in disabled modules everything is correct:

```bash
List of disabled modules:
TestTask_SimpleTest
```

Run this command to enable this module:

```bash
php bin/magento module:enable TestTask_SimpleTest
```

The module has been enabled successfully if result is like this:

```bash
The following modules has been enabled:
- TestTask_SimpleTest
```

If module is enabled for a first time Magento require to check and upgrade module database. Run:

```bash
php bin/magento setup:upgrade
```

---

## SimpleTest Module Description

### Custom Field

Added Field is in `Stores -> Configuration -> General (TAB) -> General (SECTION) -> Store Information (GROUP)`.  
The Field's label is `Simple Test Field Label`.  
The Field's path is `general/store_information/simple_test_description`.

### CLI

Run command without param (store ID):

```bash
php bin/magento simpletest:get
```

or with param:

```bash
php bin/magento simpletest:get --store-id ID
```

### REST API

URLs:

- `/rest/V1/simpletest/json` - response json string
- `/rest/V1/simpletest/array-of-arrays` - response array of arrays
- ~~`/rest/V1/simpletest/array-of-objects` - response array of objects~~ - Need to proper implement this one!
