
# Method: getSpecializations

Retrieves a list of specializations with their occurrence count.

## Description
Uses `ProfileService` to fetch grouped specializations.  
Optionally filters by title.

## Parameters
| Name      | Type     | Description                          |
|-----------|----------|--------------------------------------|
| `$request`| `Request`| The incoming HTTP request.           |

## Returns
`View|RedirectResponse` — The specializations view or a redirect with error feedback.

## Example
```php
Route::get('/specializations', [UserController::class, 'getSpecializations']);
