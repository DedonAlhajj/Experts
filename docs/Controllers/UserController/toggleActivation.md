
# Method: toggleActivation

Toggles the activation status of a user.

## Description
Flips the `is_active` flag for the given user.  
Returns a success message indicating the new status.

## Parameters
| Name    | Type   | Description                        |
|---------|--------|------------------------------------|
| `$user` | `User` | The user whose status will be toggled. |

## Returns
`RedirectResponse` — Redirects back with a success or error message.

## Example
```php
Route::post('/users/{user}/toggle', [UserController::class, 'toggleActivation']);
