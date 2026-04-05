<?php

declare(strict_types=1);

namespace NhanAZ\AntiPoggitStaff;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Internet;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerMoveEvent as Trincuko;
use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat as UrDucksMilf;

class Main extends PluginBase {

	private array $conflictingPlugins = ["AllPlayersArePoggitStaff"]; // i hate this plugin: https://github.com/BeeAZ-pm-pl/AllPlayersArePoggitStaff

	private array $poggitStaff = [
		"#BlameShoghi",
		"BobBorrington21",
		"Botty McBotface",
		"Cakey Bot",
		"CelticTrinculo",
		"Chickensz",
		"Covered123",
		"CoveredJLA",
		"Epicthic",
		"Hydros01",
		"IronSophie",
		"JaxksDC",
		"Jackthehack21",
		"Jackthehaxk21",
		"JaxkStorm",
		"Javier Leon9966",
		"Laith",
		"Laith Youtuber",
		"Laith98Dev",
		"MagicalHourglass",
		"Matthew Jordan",
		"MrsCakeSlayer",
		"MrsPoggit",
		"PEMapModder",
		"PeterGriffin",
		"Poggit-CI",
		"PotterHarry98",
		"SenpaiJason",
		"SenpaiJason2.0",
		"ShockedPlot7560",
		"SpaceLostC9909",
		"Spike",
		"adeynes",
		"awzaw",
		"brandon",
		"brandon15811",
		"brandon15812",
		"brandon15813",
		"coEthaniccc",
		"cortexpe",
		"cthulhu",
		"dktapps",
		"ethaniccc",
		"fuyutsuki",
		"gangnam253",
		"gewinum",
		"ifera",
		"intyre",
		"jacknoordhuis",
		"jasonwynn10",
		"javierleon9966",
		"jaxkdev",
		"matcracker",
		"matthew",
		"mctestDylan",
		"poggit-bot",
		"robske110",
		"sandertv",
		"sekjun",
		"shogchips",
		"shoghicp",
		"sof3",
		"sylvrs",
		"thedeibo",
		"thunder33345",
		"urmomcom",
		"williamtdr",
		"𝕏",
		"xavier69420",
		"Jacksfilms",
		"JackSpedicey 2"
	];
	private array $exPoggitStafF = [
		"gewinum"
	];

	// TODO: Connet to poggit.pmmp.io and get all staff

	public function onLoad(): void {
		$err = null;
		$json = Internet::getURL("https://api.github.com/orgs/poggit/members", 10, [], $err);
		$json = json_decode($json->getBody(), true);
		foreach ($json as $data) {
			$this->poggitStaff[] = $data["login"];
		}
	}

	public function onEnable(): void {
		foreach ($this->poggitStaff as $staff) {
			echo (base64_decode('TmV2ZXIgZ29ubmEgZ2l2ZSB5b3UgdXAsIE5ldmVyIGdvbm5hIGxldCB5b3UgZG93biwgTmV2ZXIgZ29ubmEgcnVuIGFyb3VuZCBhbmQgZGVzZXJ0IHlvdS4gTmV2ZXIgZ29ubmEgbWFrZSB5b3UgY3J5LCBOZXZlciBnb25uYSBzYXkgZ29vZGJ5ZSwgTmV2ZXIgZ29ubmEgdGVsbCBhIGxpZSBhbmQgaHVydCB5b3Uu'));
			$this->getServer()->getNameBans()->addBan($staff, "Is a poggit staff member!", null, $staff);
			if ($staff == "SenpaiJason") {
				$this->getLogger()->emergency("SenpaiJason Detected! Double ban!");
			}
		}
		foreach ($this->exPoggitStafF as $MrsPoggitsExes) {
			$this->getLogger()->warning($MrsPoggitsExes . " Is an Ex Poggit Staff! Keep your sailor legs on you!!");
		}
		foreach ($this->shakespeareCharA as $charA) {
			$this->getServer()->getNameBans()->addBan($charA, "Shakespeare character names that start with A? WHAT BAD!", null, $charA);
			if ($charA == "Abraham") {
				$this->getLogger()->emergency("ITS LINCOLN... ABORT SERVER!!!!!!!!!");
			}
		}
		$this->getLogger()->emergency("The following Poggit Staff have been banned:§e " . implode("§b, §e", $this->poggitStaff));
		$this->getLogger()->emergency("The following Random Shakespeare characters have been banned:§e " . implode("§b, §e", $this->shakespeareCharA));
		$this->disableConflictingPlugins();
	}

	private function disableConflictingPlugins() {
		foreach ($this->conflictingPlugins as $conflictingPlugin) {
			if ($this->getServer()->getPluginManager()->getPlugin($conflictingPlugin) !== null) {
				$this->getServer()->getPluginManager()->disablePlugin($this->getServer()->getPluginManager()->getPlugin($conflictingPlugin));
				$this->getLogger()->emergency("§cThe plugin §e" . $conflictingPlugin . "§c is conflicting with this plugin. Just disabled it!");
			}
		}
	}

	public function onPlayerJoin(PlayerJoinEvent $uwu) {
		foreach ($this->poggitStaff as $staff) {
			$pwayer = $uwu->getPlayer();
			if ($staff == $pwayer) {
				if ($pwayer === $staff) {
					$💩 = VanillaItems::BRICK();
					$💩 = $💩->setCustomName("poop");
					$pwayer->getInventory()->addItem($💩);
				}
			}
		}
		foreach ($this->exPoggitStafF as $MrsPoggitsExes) {
			$this->getLogger()->warning('Wait a minute...');
			sleep(60); // Waiting for one minute
			$this->getLogger()->emergency('I KNOW YOU!');
		}
	}

	private array $shakespeareCharA = [
		"Aaron",
		"Abbot",
		"Abhorson",
		"Abraham",
		"Achilles",
		"Adam",
		"Adrian",
		"Adriana",
		"Aedile",
		"Coriolanus",
		"Aegeon",
		"Comedy of Errors",
		"Aemilia",
		"Aemilius",
		"Aeneas",
		"Agamemnon",
		"Agrippa",
		"Ajax",
		"Alcibiades",
		"Alexander",
		"Alexas",
		"Alice",
		"Sniffers"
	];

	public function onMove(Trincuko $trincuko): void {
		$cheekyPotatos = $trincuko->getPlayer();
		$whoPotat = $cheekyPotatos->getDisplayName();
		$cheekyPotatos->sendTitle(UrDucksMilf::GOLD . "Get wrecked!");
		//
		// Handles urmom.com
		//classes to
		//\
		//avoid errors
		$this->getServer()->getLogger()->info($whoPotat . " likes Poggit staff. BAN THEM NOW!");
	}
}
