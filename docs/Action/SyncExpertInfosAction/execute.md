# Method: execute

Synchronizes the user's expert experiences with the database.

## Description
This method performs checksum-based synchronization:
- Deletes outdated records not present in the new data.
- Performs an upsert based on unique keys (`user_id`, `category`, `title`).

## Parameters
| Name | Type | Description |
|------|------|-------------|
| `$user` | `User` | The user whose experiences are being updated. |
| `$experiences` | `array` | Array of experience data (each with `category` and `title`). |

## Returns
`array` — Contains the number of deleted and upserted records.

## Example
```php
$action = new SyncExpertInfosAction();
$result = $action->execute($user, $experiences);
