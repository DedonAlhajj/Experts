# Method: getProfileWithExpertInfo

Retrieves a user's profile along with their expert information grouped by category.

## Description
This method:
- Uses eager loading to fetch related `infos` and `media` efficiently.
- Orders expert infos by category.
- Groups the infos by category for structured display.

## Parameters
| Name    | Type   | Description                        |
|---------|--------|------------------------------------|
| `$user` | `User` | The user whose profile is being retrieved. |

## Returns
`array` — Contains:
- `user`: The user model with media loaded.
- `expert_infos`: A collection of expert infos grouped by category.

## Throws
- `RuntimeException` — If the query fails.

## Example
```php
$data = $profileService->getProfileWithExpertInfo($user);

$user = $data['user'];
$infos = $data['expert_infos'];
