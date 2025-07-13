
# Method: destroy

Deletes the authenticated user's account.

## Description
Validates the current password, logs out the user, deletes the account,  
invalidates the session, and redirects to the homepage.

## Parameters
| Name      | Type     | Description                     |
|-----------|----------|---------------------------------|
| `$request`| `Request`| The incoming HTTP request.      |

## Returns
`RedirectResponse` — Redirects to the homepage.

## Example
```php
Route::delete('/profile', [ProfileController::class, 'destroy']);
