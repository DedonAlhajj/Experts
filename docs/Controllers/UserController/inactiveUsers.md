
# Method: inactiveUsers

Retrieves a paginated list of inactive users based on optional filters.

## Description
Filters users marked as inactive.  
Applies optional filters for location, title, and name.

## Parameters
| Name      | Type     | Description                          |
|-----------|----------|--------------------------------------|
| `$request`| `Request`| The incoming HTTP request.           |

## Returns
`View|RedirectResponse` — The inactive users view or a redirect with error feedback.

## Example
```php
Route::get('/inactive-users', [UserController::class, 'inactiveUsers']);
