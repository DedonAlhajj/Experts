
# Method: getJobSeeker

Retrieves a paginated list of job seekers based on optional filters.

## Description
This method filters users who are marked as job seekers and active.  
It applies optional filters for location, name, and title, and includes media relations.

## Parameters
| Name      | Type         | Description                              |
|-----------|--------------|------------------------------------------|
| `$location` | `string|null` | Location keywords (country or city).     |
| `$title`    | `string|null` | Title to filter expertise.               |
| `$name`     | `string|null` | Name to filter users.                    |

## Returns
`LengthAwarePaginator` — Paginated list of job seekers.

## Throws
- `RuntimeException` — If the query fails.

## Example
```php
$seekers = $profileService->getJobSeeker('Aleppo', 'Designer', 'Rami');
