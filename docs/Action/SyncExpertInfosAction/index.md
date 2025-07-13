# SyncExpertInfosAction

This class handles expert experience synchronization for a given user.  
It uses checksum-based validation to detect outdated records and performs efficient upserts.

## Methods
- [`execute`](execute.md): Syncs expert experiences with the database.
- [`prepareData`](prepareData.md): Prepares and normalizes experience data.
