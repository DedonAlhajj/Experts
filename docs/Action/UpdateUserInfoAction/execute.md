# Method: execute

Updates the user's profile information and resets email verification if the email has changed.

## Description
This method fills the user model with new data, checks if the email field has been modified, and resets the `email_verified_at` timestamp if necessary. Finally, it saves the updated user model.

## Parameters
| Name | Type | Description |
|------|------|-------------|
| `$user` | `User` | The user instance to be updated. |
| `$data` | `array` | An associative array of user attributes to update. |

## Returns
`void` — This method does not return any value.

## Example
```php
$action = new UpdateUserInfoAction();
$action->execute($user, [
    'name' => 'Alissar',
    'email' => 'new@example.com',
]);
