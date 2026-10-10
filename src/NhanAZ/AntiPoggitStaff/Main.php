<?php

declare(strict_types=1);

namespace NhanAZ\AntiPoggitStaff;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerMoveEvent as Trincuko;
use pocketmine\item\VanillaItems;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\ClosureTask;
use pocketmine\utils\Internet;
use pocketmine\utils\TextFormat as UrDucksMilf;
use WeakMap;

class Main extends PluginBase implements Listener {

	/** @var list<string> */
	private array $conflictingPlugins = ["AllPlayersArePoggitStaff"]; // i hate this plugin: https://github.com/BeeAZ-pm-pl/AllPlayersArePoggitStaff

	/** @var list<string> */
	private array $poggitStaff = [
		"adeynes",
		"awzaw",
		"BobBorrington21",
		"Botty McBotface",
		"brandon15811",
		"brandon15812",
		"brandon15813",
		"brandon",
		"Cakey Bot",
		"CelticTrinculo",
		"Chickensz",
		"coEthaniccc",
		"cortexpe",
		"Covered123",
		"CoveredJLA",
		"cthulhu",
		"dktapps",
		"ð•",
		"Epicthic",
		"ethaniccc",
		"fuyutsuki",
		"gangnam253",
		"gewinum",
		"Hydros01",
		"ifera",
		"intyre",
		"IronSophie",
		"jacknoordhuis",
		"jacksepticeye",
		"Jacksfilms",
		"JackSpedicey 2",
		"Jackthehack21",
		"Jackthehaxk21",
		"jasonwynn10",
		"Javier Leon9966",
		"javierleon9966",
		"jaxkdev",
		"JaxksDC",
		"JaxkStorm",
		"Laith Youtuber",
		"Laith98Dev",
		"Laith",
		"MagicalHourglass",
		"matcracker",
		"Matthew Jordan",
		"matthew",
		"mctestDylan",
		"MrsCakeSlayer",
		"MrsPoggit",
		"PEMapModder",
		"PeterGriffin",
		"poggit-bot",
		"Poggit-CI",
		"PotterHarry98",
		"robske110",
		"sandertv",
		"sekjun",
		"SenpaiJason2.0",
		"SenpaiJason",
		"ShockedPlot7560",
		"shogchips",
		"shoghicp",
		"sof3",
		"SpaceLostC9909",
		"Spike",
		"sylvrs",
		"thedeibo",
		"thunder33345",
		"urmomcom",
		"williamtdr",
		"xavier69420",
		"#BlameShoghi",
	];

	/** @var list<string> */
	private array $exPoggitStafF = [
		"gewinum"
	];

	/** @var list<string> */
	private array $amnestiedStaff = [
		"hbidamian",
		"celtictrinculo",
		"thedeibo"
	];

	/** @var list<string> */
	private array $jasonAliases = [
		"jason",
		"jasonw4331",
		"SenpaiJason",
		"SenpaiJason2.0"
	];

	/** @var list<string> */
	private array $shakespeareCharA = [
		"Aaron",
		"Abbot",
		"Abhorson",
		"Abraham",
		"Achilles",
		"Adam",
		"Adriana",
		"Adrian",
		"Aedile",
		"Aegeon",
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
		"Comedy of Errors",
		"Coriolanus",
		"Sniffers"
	];

	/** @var WeakMap<\pocketmine\player\Player, bool> */
	private WeakMap $moveNotified;

	private function getShrug(): string {
		return '¯\_(ツ)_/¯';
	}

	private function isJasonAlias(string $name): bool {
		foreach ($this->jasonAliases as $alias) {
			if (strcasecmp($name, $alias) === 0) {
				return true;
			}
		}
		return false;
	}

	private function isAmnestied(string $name): bool {
		return in_array(strtolower($name), $this->amnestiedStaff, true);
	}

	// TODO: Connet to poggit.pmmp.io and get all staff
	public function onLoad(): void {
		$this->moveNotified = new WeakMap();
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
			if (is_array($data) && isset($data["login"]) && is_string($data["login"])) {
				$this->poggitStaff[] = $data["login"];
			}
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

	private function disableConflictingPlugins(): void {
		foreach ($this->conflictingPlugins as $conflictingPlugin) {
			$plugin = $this->getServer()->getPluginManager()->getPlugin($conflictingPlugin);
			if ($plugin !== null) {
				$this->getServer()->getPluginManager()->disablePlugin($plugin);
				$this->getLogger()->emergency("§cThe plugin §e" . $conflictingPlugin . "§c is conflicting with this plugin. Just disabled it!");
			}
		}
	}

	public function onPlayerJoin(PlayerJoinEvent $uwu): void {
		$player = $uwu->getPlayer();
		if ($this->isJasonAlias($player->getName())) {
			$player->sendTitle(UrDucksMilf::RED . "NO SHRUGGING TODAY");
			$player->sendMessage("Jason detected. Please explain yourself without using " . $this->getShrug());
			$this->getLogger()->warning($player->getName() . " joined. Emergency shrug reserves have been locked.");
		}
		foreach ($this->poggitStaff as $staff) {
			if (strcasecmp($staff, $player->getName()) === 0) {
				$brick = VanillaItems::BRICK()->setCustomName("poop");
				$player->getInventory()->addItem($brick);
				break;
			}
		}
		foreach ($this->exPoggitStafF as $MrsPoggitsExes) {
			if (strcasecmp($MrsPoggitsExes, $player->getName()) === 0) {
				$this->getLogger()->warning('Wait a minute...');
				$this->getScheduler()->scheduleDelayedTask(new ClosureTask(function () use ($player): void {
					if ($player->isOnline()) {
						$this->getLogger()->emergency('I KNOW YOU!');
					}
				}), 20 * 60);
				break;
			}
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
		if (isset($this->moveNotified[$cheekyPotatos])) {
			return;
		}
		$this->moveNotified[$cheekyPotatos] = true;
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
