<?php

namespace LC\commands;

use pocketmine\block\VanillaBlocks;
use pocketmine\entity\object\ItemEntity;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemTypeIds;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat as MG;
use pocketmine\Server;
use pocketmine\plugin\Plugin;
use pocketmine\item\Item;

use LC\LobbyCore;

class HubCommand extends Command
{
    private $plugin;

    public function __construct()
    {
        parent::__construct("hub", "hub command", null, ["spawn", "lobby"]);
        $this->setPermission("lobbycore.command.hub");
    }

    public function execute(CommandSender $player, string $label, array $args)
    {
        if (!$player instanceof Player)return;
        
        $this->plugin = LobbyCore::getInstance();
        $player->teleport($player->getServer()->getWorldManager()->getDefaultWorld()->getSafeSpawn());
        $player->getInventory()->clearALL();
        $player->getArmorInventory()->clearALL();

        $item1 = VanillaBlocks::ENDER_CHEST()->asItem();
        $item1->setCustomName("§r§bCosmetics§l");

        $item2 = VanillaBlocks::ANVIL()->asItem();
        $item2->setCustomName("§r§cReport Player§l");

        $item3 = VanillaItems::COMPASS();
        $item3->setCustomName("§r§aTeleporter§l");

        $item4 = VanillaItems::POPPED_CHORUS_FRUIT();
        $item4->setCustomName("§r§bINFO §fUI");

        $item5 = VanillaItems::NETHER_STAR();
        $item5->setCustomName("§r§5Lobby§l");

        $player->getInventory()->setItem(0, $item1);
        $player->getInventory()->setItem(1, $item2);
        $player->getInventory()->setItem(4, $item3);
        $player->getInventory()->setItem(7, $item4);
        $player->getInventory()->setItem(8, $item5);
    }
}
