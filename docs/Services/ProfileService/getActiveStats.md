
# Method: getActiveStats

Retrieves statistical counts of active users.

## Description
Returns an object with:
- `total_active`
- `total_experts`
- `total_job_seekers`
- `male_count`
- `female_count`

## Returns
`object` — Statistical breakdown of active users.

## Example
```php
$stats = $this->getActiveStats();
