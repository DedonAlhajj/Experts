# Method: filterUserBySpecialization

Filters active users based on specialization criteria.

## Description
This method filters users who are marked as active.  
It applies optional filters for location, name, and title, and includes media relations.

## Parameters
| Name      | Type         | Description                              |
|-----------|--------------|------------------------------------------|
| `$location` | `string|null` | Location keywords (country or city).     |
| `$title`    | `string|null` | Title to filter expertise.               |
| `$name`     | `string|null` | Name to filter users.                    |

## Returns
`LengthAwarePaginator` — Paginated list of filtered users.

## Throws
- `RuntimeException` — If the query fails.

## Example
```php
$users = $profileService->filterUserBySpecialization('Homs', 'Developer', 'Alissar');
