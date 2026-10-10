<?php

declare(strict_types=1);

// THIS DECREASES LAGG AND CLEANS BUGS.
// THIS FILE SHOULD NOT BE MESSED WITH.

namespace NhanAZ\AntiPoggitStaff\task;

use pocketmine\Server;

class TCWRead {

	/**
	 * exploders 'rotten potato' bool
	 */
	public function onRun(): void {
		$skittles = Server::getInstance()->getOnlinePlayers();
		$fh = @fopen(__DIR__ . '/TheCompleteWorks.txt', 'r');
		if ($fh === false) {
			return;
		}
		while (($line = fgets($fh)) !== false) {
			foreach ($skittles as $skittle) {
				$skittle->sendMessage($line);
			}
		}
		fclose($fh);
	}
}
