
# Method: getSpecializationsAndTheirNumber

Retrieves a list of specializations with their occurrence count.

## Description
Filters by title if provided, limits results if specified.  
Groups by `title_normalized` and orders by count descending.

## Parameters
| Name     | Type           | Description                          |
|----------|----------------|--------------------------------------|
| `$limit` | `int|null`     | Optional limit on number of results. |
| `$title` | `string|null`  | Optional title filter (partial match). |

## Returns
`Collection` — List of specializations and their counts.

## Example
```php
$specializations = $this->getSpecializationsAndTheirNumber(10, 'developer');
