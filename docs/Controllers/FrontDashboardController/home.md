# Method: home

Displays the homepage with active user statistics and grouped specializations.

## Description
This method:
- Calls `ProfileService::getActiveUsersWithStats()` to retrieve homepage data.
- Passes the data to the `home` view.
- Handles exceptions gracefully by redirecting back with an error message.

## Returns
`View|RedirectResponse` — The homepage view or a redirect with error feedback.

## Throws
- `Exception` — If data retrieval fails.

## Example
```php
Route::get('/', [FrontDashboardController::class, 'home']);
