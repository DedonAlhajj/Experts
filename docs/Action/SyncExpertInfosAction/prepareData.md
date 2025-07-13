# Method: prepareData

Prepares and normalizes experience data for synchronization.

## Description
Filters out entries without a title, adds normalized title and checksum.  
The checksum is used to detect changes and avoid redundant updates.

## Parameters
| Name | Type | Description |
|------|------|-------------|
| `$user` | `User` | The user associated with the experiences. |
| `$experiences` | `array` | Raw experience data. |

## Returns
`Collection` — A collection of structured experience records.

## Example
```php
$data = $this->prepareData($user, $experiences);
