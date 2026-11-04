# AntiPoggitStaff

Satirical Axolotl-PM plugin that updates the name ban list and reacts to player names

[![CI](https://github.com/NhanAZ-Plugins/AntiPoggitStaff/actions/workflows/ci.yml/badge.svg)](https://github.com/NhanAZ-Plugins/AntiPoggitStaff/actions/workflows/ci.yml)
[![Latest release](https://img.shields.io/github/v/release/NhanAZ-Plugins/AntiPoggitStaff)](https://github.com/NhanAZ-Plugins/AntiPoggitStaff/releases/latest)
[![License](https://img.shields.io/github/license/NhanAZ-Plugins/AntiPoggitStaff)](https://github.com/NhanAZ-Plugins/AntiPoggitStaff/blob/master/LICENSE)
[![Discord](https://img.shields.io/discord/986553214889517088?label=Discord&logo=discord&logoColor=white&color=5865F2)](https://discord.gg/j2X83ujT6c)


## Requirements and compatibility

The manifest declares Axolotl-PM API `5.0.0`. PHPStan at maximum level passes against the 5.0.0 and 5.51.1 source revisions. The [build workflow](.github/workflows/ci.yml) pins the exact server source for repeatable checks. Runtime startup has been tested on 5.51.1, but intermediate releases and connected player behavior are not verified.

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


## Credits

Authors: NhanAZ.
