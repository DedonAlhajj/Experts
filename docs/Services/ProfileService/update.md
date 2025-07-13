# Method: update

Updates the user's profile information, expert experiences, and media files.

## Description
This method acts as a coordinator for multiple profile-related actions:
- Extracts and separates media files (`profile_image`, `cv_file`) from the input data.
- Updates basic user attributes via `UpdateUserInfoAction`.
- Synchronizes expert experiences using `SyncExpertInfosAction`.
- Uploads profile image and CV file using their respective actions.
- Logs errors and throws a `RuntimeException` if any step fails.

## Parameters
| Name   | Type   | Description |
|--------|--------|-------------|
| `$user` | `User` | The user whose profile is being updated. |
| `$data` | `array` | Profile data including attributes, experiences, and media files. |

## Returns
`void` — This method does not return any value.

## Throws
- `RuntimeException` — If any part of the update process fails.

## Example
```php
$service = new ProfileService();
$service->update($user, [
    'name' => 'Alissar',
    'email' => 'alissar@example.com',
    'experiences' => [...],
    'profile_image' => request()->file('profile_image'),
    'cv_file' => request()->file('cv_file'),
]);
