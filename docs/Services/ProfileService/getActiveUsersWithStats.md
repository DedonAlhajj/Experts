# Method: getActiveUsersWithStats

Retrieves homepage data including active users, statistics, and grouped specializations.

## Description
This method:
- Fetches the latest 6 active users.
- Caches user statistics for 10 minutes.
- Caches grouped specializations for 15 minutes.
- Logs errors and returns fallback data if any step fails.

## Returns
`array` — Contains:
- `users`: Collection of active users.
- `stats`: Object with statistical fields.
- `specializations`: Collection of grouped specializations.

## Throws
- `Throwable` — If any part of the process fails.

## Example
```php
$data = $profileService->getActiveUsersWithStats();
