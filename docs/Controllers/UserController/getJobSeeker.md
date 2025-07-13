# Method: getJobSeeker

Retrieves a paginated list of job seekers based on optional filters.

## Description
Filters users marked as job seekers and active.  
Applies optional filters for location, title, and name.

## Parameters
| Name      | Type     | Description                          |
|-----------|----------|--------------------------------------|
| `$request`| `Request`| The incoming HTTP request.           |

## Returns
`View|RedirectResponse` — The job seeker view or a redirect with error feedback.

## Example
```php
Route::get('/job-seekers', [UserController::class, 'getJobSeeker']);
