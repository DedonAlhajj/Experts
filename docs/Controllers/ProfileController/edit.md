# Method: edit

Displays the profile edit form for the authenticated user.

## Description
Retrieves the user's profile and expert infos using `ExpertInfoService`,  
then passes the data to the `profile.edit` view.

## Parameters
| Name      | Type     | Description                     |
|-----------|----------|---------------------------------|
| `$request`| `Request`| The incoming HTTP request.      |

## Returns
`View|RedirectResponse` — The edit view or a redirect with error feedback.

## Example
```php
Route::get('/profile/edit', [ProfileController::class, 'edit']);
