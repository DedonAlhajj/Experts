# Method: execute

Uploads a CV file for the given user.

## Description
This method checks if a CV file is provided. If so, it uploads the file using the user's `uploadMediaFile` method and stores it under the `cv_file` media collection.

## Parameters
| Name     | Type                          | Description                                 |
|----------|-------------------------------|---------------------------------------------|
| `$user`  | `User`                        | The user who is uploading the CV.           |
| `$cvFile`| `UploadedFile|null`           | The CV file to upload, or `null`.           |

## Returns
`void` — This method does not return any value.

## Throws
- `Exception` — If the upload process fails internally.

## Example
```php
$action = new UploadCvFileAction();
$action->execute($user, request()->file('cv_file'));
