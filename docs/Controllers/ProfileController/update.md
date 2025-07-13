
# Method: update

Updates the authenticated user's profile information.

## Description
Uses `ProfileUpdateRequest` to validate input,  
then calls `ProfileService::update()` to persist changes.  
Redirects with success or error feedback.

## Parameters
| Name      | Type                  | Description                     |
|-----------|-----------------------|---------------------------------|
| `$request`| `ProfileUpdateRequest`| The validated update request.   |

## Returns
`RedirectResponse` — Redirects to the edit page or back with errors.

## Example
```php
Route::patch('/profile', [ProfileController::class, 'update']);
