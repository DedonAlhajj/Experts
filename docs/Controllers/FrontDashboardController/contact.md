
# Method: contact

Displays the contact page.

## Description
Returns the `contact` view.  
Handles exceptions by redirecting back with an error message.

## Returns
`View|RedirectResponse` — The contact view or a redirect with error feedback.

## Throws
- `Exception` — If view rendering fails.

## Example
```php
Route::get('/contact', [FrontDashboardController::class, 'contact']);
