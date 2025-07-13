# Method: filterBySpecialization

Filters expert users by specialization and optional location or name.

## Description
This method:
- Extracts `location` and `name` from the request.
- Calls `ProfileService::filterUserBySpecialization()` with the provided filters.
- Returns the `expert-by-specialization` view with the filtered experts.

## Parameters
| Name      | Type     | Description                          |
|-----------|----------|--------------------------------------|
| `$request`| `Request`| The incoming HTTP request.           |
| `$title`  | `string` | The specialization title to filter.  |

## Returns
`View|RedirectResponse` — The filtered expert view or a redirect with error feedback.

## Throws
- `Throwable` — If filtering fails.

## Example
```php
Route::get('/experts/specialization/{title}', [UserController::class, 'filterBySpecialization']);
