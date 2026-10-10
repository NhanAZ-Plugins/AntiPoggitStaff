# AntiPoggitStaff

A satire plugin for Axolotl-PM that adds names from a built-in list and the public Poggit organization member API to the server's name ban list. It also reacts to selected player names and chat messages. Read [the longer satire](SATIRICAL-README.md) for the original tone of the project.

> [!WARNING]
> Enabling this plugin changes the server's persistent name ban list. It bans the listed accounts and several fictional names on startup, and removes bans for three amnestied names. Install it only on a server where those changes are intended. Back up `banned-players.txt` before installation.

## Requirements and compatibility

The manifest declares Axolotl-PM API `5.0.0`. PHPStan at maximum level passes against the 5.0.0 and 5.49.1 source revisions. The [build workflow](.github/workflows/ci.yml) pins the exact server source for repeatable checks. Runtime startup has been tested on 5.49.1, but intermediate releases and connected player behavior are not verified.

## Installation and behavior

1. Back up the server's name ban list and stop the server.
2. Download the verified PHAR from a successful [build workflow](.github/workflows/ci.yml) run or a matching GitHub release.
3. Put the PHAR in the server's `plugins` directory and start the server.

On startup, the plugin tries to read public Poggit organization members from GitHub with a ten-second timeout. The built-in list still runs if that request fails. It bans names in that list and its fictional character list, then registers player event handlers. A join by a listed account may receive a named brick. A selected alias cannot send a shrug in chat. The movement title is shown once per player session. A matching former member receives a delayed log message without stopping the server thread.

The text reader in `src/NhanAZ/AntiPoggitStaff/task` is not scheduled by the plugin. It has no effect during normal startup.

## Building and testing

The [CI workflow](.github/workflows/ci.yml) runs PHP syntax checks, name matching tests and PHPStan at maximum level, then uses [DevTools](https://github.com/NhanAZ/DevTools) to build and inspect the PHAR. For a local build, run:

```shell
php -d phar.readonly=0 path/to/DevTools/bin/devtools.php build --project=. --json
```

## License and support

AntiPoggitStaff is MIT licensed. Report issues in this repository or contact [NhanAZ Discord](https://discord.gg/j2X83ujT6c).
