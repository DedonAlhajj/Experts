# Method: toggleActivation

Toggles the activation status of a user.

## Description
This method reverses the `is_active` flag for a given user:
- If the user is active, they will be deactivated.
- If the user is inactive, they will be activated.

It returns a message indicating the result and logs any errors that occur during the update.

## Parameters
| Name    | Type   | Description                        |
|---------|--------|------------------------------------|
| `$user` | `User` | The user whose status will be toggled. |

## Returns
`string` — A message indicating whether the user was activated or deactivated.

## Throws
- `RuntimeException` — If the update fails.

## Example
```php
$message = $profileService->toggleActivation($user);
echo $message; // "The user was successfully activated." or "The user was successfully deactivated."
