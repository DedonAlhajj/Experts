
# Method: getExperts

Retrieves all expert users based on optional filters.

## Description
This method:
- Extracts `title`, `location`, and `name` from the request.
- Calls `ProfileService::getExperts()` to retrieve expert users.
- Returns the `expert` view with the results.

## Parameters
| Name      | Type     | Description                          |
|-----------|----------|--------------------------------------|
| `$request`| `Request`| The incoming HTTP request.           |

## Returns
`View|RedirectResponse` — The expert view or a redirect with error feedback.

## Throws
- `Throwable` — If data retrieval fails.

## Example
```php
Route::get('/experts', [UserController::class, 'getExperts']);
