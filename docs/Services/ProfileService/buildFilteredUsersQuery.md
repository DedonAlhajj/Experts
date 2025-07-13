# Method: buildFilteredUsersQuery

Builds a filtered query for users based on location, name, title, and category.

## Description
This method dynamically applies filters to a base user query:
- **Location**: Splits the input into keywords and matches them against `country` and `city` fields.
- **Name**: Performs a case-insensitive partial match.
- **Expertise**: Filters related `infos` records by `category` and `title_normalized`.

## Parameters
| Name        | Type     | Description |
|-------------|----------|-------------|
| `$baseQuery`| `Builder`| The initial user query builder. |
| `$location` | `string|null` | Comma-separated location keywords. |
| `$title`    | `string|null` | Partial title to match. |
| `$name`     | `string|null` | Partial name to match. |
| `$category` | `string|null` | Category to filter expertise. |

## Returns
`Builder` — The modified query builder with applied filters.

## Example
```php
$query = User::query();
$filtered = $this->buildFilteredUsersQuery($query, 'Damascus,Homs', 'Engineer', 'Alissar', 'IT');
$results = $filtered->get();
