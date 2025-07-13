# Method: getExperts

Retrieves a paginated list of expert users based on optional filters.

## Description
This method filters users who are marked as experts and active.  
It applies optional filters for location, name, and title, and includes media relations.

## Parameters
| Name      | Type         | Description                              |
|-----------|--------------|------------------------------------------|
| `$location` | `string|null` | Location keywords (country or city).     |
| `$title`    | `string|null` | Title to filter expertise.               |
| `$name`     | `string|null` | Name to filter users.                    |

## Returns
`LengthAwarePaginator` — Paginated list of expert users.

## Throws
- `RuntimeException` — If the query fails.

## Example
```php
$experts = $profileService->getExperts('Damascus', 'Engineer', 'Alissar');
