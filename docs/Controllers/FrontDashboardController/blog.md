
# Method: blog

Displays the blog page.

## Description
Returns the `blog` view.  
Handles exceptions by redirecting back with an error message.

## Returns
`View|RedirectResponse` — The blog view or a redirect with error feedback.

## Throws
- `Exception` — If view rendering fails.

## Example
```php
Route::get('/blog', [FrontDashboardController::class, 'blog']);
