<?php

declare(strict_types=1);

namespace NhanAZ\AntiPoggitStaff;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerMoveEvent as Trincuko;
use pocketmine\item\VanillaItems;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Internet;
use pocketmine\utils\TextFormat as UrDucksMilf;

class Main extends PluginBase implements Listener {

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
		"ð•",
		"xavier69420",
		"Jacksfilms",
		"jacksepticeye",
		"JackSpedicey 2"
	];

	private array $exPoggitStafF = [
		"gewinum"
	];

	private array $amnestiedStaff = [
		"hbidamian",
		"celtictrinculo",
		"thedeibo"
	];

	private array $jasonAliases = [
		"jason",
		"jasonw4331",
		"SenpaiJason",
		"SenpaiJason2.0"
	];

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

	private function getShrug(): string {
		return '¯\_(ツ)_/¯';
	}

	private function isJasonAlias(string $name): bool {
		return in_array(strtolower($name), $this->jasonAliases, true);
	}

	private function isAmnestied(string $name): bool {
		return in_array(strtolower($name), $this->amnestiedStaff, true);
	}

	// TODO: Connet to poggit.pmmp.io and get all staff
	public function onLoad(): void {
		$err = null;
		$this->getLogger()->info("[NhanAZ-Plugins] Loading repos...");
		$json = Internet::getURL("https://api.github.com/orgs/poggit/members", 10, [], $err);
		if ($json === null || $err !== null) {
			$this->getLogger()->warning("Why is it taking so long to load? Jason's patented shrug-powered loading screen is still buffering.");
			$this->getLogger()->warning("It's frozen there. Poggit support has escalated this to the Emergency Shrug Department.");
			$this->getLogger()->info("Jason: " . $this->getShrug());
			return;
		}
		$json = json_decode($json->getBody(), true);
		if (!is_array($json)) {
			$this->getLogger()->warning("Loading repos... forever, apparently. Classic Jason-grade troubleshooting.");
			$this->getLogger()->info("Jason: " . $this->getShrug());
			return;
		}
		foreach ($json as $data) {
			$this->poggitStaff[] = $data["login"];
		}
	}

	public function onEnable(): void {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info("Anti-shrug safeguards enabled. Jason containment status: unstable but funny.");
		$nameBans = $this->getServer()->getNameBans();
		$bannedPoggitStaff = [];
		foreach ($this->amnestiedStaff as $staff) {
			$nameBans->remove($staff);
		}
		$this->getLogger()->info("Official amnesty granted to HBIDamian, CelticTrinculo, and TheDeibo for service to the Anti Poggit Staff council.");
		foreach ($this->poggitStaff as $staff) {
			echo (base64_decode('TmV2ZXIgZ29ubmEgZ2l2ZSB5b3UgdXAsIE5ldmVyIGdvbm5hIGxldCB5b3UgZG93biwgTmV2ZXIgZ29ubmEgcnVuIGFyb3VuZCBhbmQgZGVzZXJ0IHlvdS4gTmV2ZXIgZ29ubmEgbWFrZSB5b3UgY3J5LCBOZXZlciBnb25uYSBzYXkgZ29vZGJ5ZSwgTmV2ZXIgZ29ubmEgdGVsbCBhIGxpZSBhbmQgaHVydCB5b3Uu'));
			if ($this->isAmnestied($staff)) {
				continue;
			}
			$nameBans->addBan($staff, "Is a poggit staff member!", null, $staff);
			$bannedPoggitStaff[] = $staff;
			if ($staff == "SenpaiJason") {
				$this->getLogger()->emergency("SenpaiJason Detected! Double ban!");
			}
		}
		foreach ($this->exPoggitStafF as $MrsPoggitsExes) {
			$this->getLogger()->warning($MrsPoggitsExes . " Is an Ex Poggit Staff! Keep your sailor legs on you!!");
		}
		foreach ($this->shakespeareCharA as $charA) {
			$nameBans->addBan($charA, "Shakespeare character names that start with A? WHAT BAD!", null, $charA);
			if ($charA == "Abraham") {
				$this->getLogger()->emergency("ITS LINCOLN... ABORT SERVER!!!!!!!!!");
			}
		}
		$this->getLogger()->emergency("The following Poggit Staff have been banned:" . "§e " . implode("§b, §e", $bannedPoggitStaff));
		$this->getLogger()->emergency("The following Random Shakespeare characters have been banned:" . "§e " . implode("§b, §e", $this->shakespeareCharA));
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
		$player = $uwu->getPlayer();
		if ($this->isJasonAlias($player->getName())) {
			$player->sendTitle(UrDucksMilf::RED . "NO SHRUGGING TODAY");
			$player->sendMessage("Jason detected. Please explain yourself without using " . $this->getShrug());
			$this->getLogger()->warning($player->getName() . " joined. Emergency shrug reserves have been locked.");
		}
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

	public function onPlayerChat(PlayerChatEvent $event): void {
		$player = $event->getPlayer();
		$message = trim($event->getMessage());
		if ($this->isJasonAlias($player->getName()) && str_contains($message, $this->getShrug())) {
			$event->cancel();
			$player->sendMessage("Nice try. Jason-related shrug deployment has been suspended: " . $this->getShrug());
			$this->getLogger()->warning($player->getName() . " attempted to deploy a shrug and was denied.");
		}
	}

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
