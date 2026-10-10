# Changelog

## 1.0.1

- Declare Axolotl-PM API 5.0.0 instead of advertising unsupported legacy API majors.
- Validate GitHub member responses before using account names.
- Fix case-insensitive alias matching and the unreachable join item branch.
- Replace a blocking one-minute sleep on player join with a delayed task for the matching account.
- Show the movement title once per player and stop repeating a decoded text passage during startup.
- Make the optional text reader advance through lines and handle a missing file safely.
- Add pinned DevTools build checks, PHPStan at maximum level and dependency update detection.
- Remove the legacy workflow that built from a moving Pockgin CLI branch and created a release after every push.
