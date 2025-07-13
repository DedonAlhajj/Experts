# ProfileService

This service class handles profile-related operations such as updating user data, syncing experiences, uploading media, and filtering users.

## Methods
- [`update`](update.md): Updates the user's profile and handles media and experience synchronization.
- [`buildFilteredUsersQuery`](buildFilteredUsersQuery.md): Builds a filtered query for users based on multiple criteria.
- [`getExperts`](getExperts.md): Retrieves a paginated list of expert users.
- [`getJobSeeker`](getJobSeeker.md): Retrieves a paginated list of job seekers.
- [`filterUserBySpecialization`](filterUserBySpecialization.md): Filters active users by specialization.
- [`inactiveUsers`](inactiveUsers.md): Retrieves inactive users based on filters.
- [`getActiveUsersWithStats`](getActiveUsersWithStats.md): Retrieves homepage data including users, stats, and specializations.
- [`getActiveStats`](getActiveStats.md): Retrieves statistical counts of active users.
- [`getSpecializationsAndTheirNumber`](getSpecializationsAndTheirNumber.md): Retrieves grouped specializations with counts.
- [`toggleActivation`](toggleActivation.md): Flips the user's activation status.
