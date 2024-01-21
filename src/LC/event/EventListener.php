<?php

namespace LC\event;

use LC\api\ItemManager;
use LC\block\RegisterBlocks;
use LC\ui\CosmeticsUI;
use LC\ui\GamesUI;
use LC\ui\InfoUI;
use pocketmine\block\Block;
use pocketmine\block\BlockTypeIds;
use pocketmine\block\VanillaBlocks;
use pocketmine\data\bedrock\item\BlockItemIdMap;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemTypeIds;
use pocketmine\item\VanillaItems;
use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as MG;
use pocketmine\event\player\PlayerInteractEvent;

use Vecnavium\FormsUI\Form;
use Vecnavium\FormsUI\FormAPI;
use Vecnavium\FormsUI\SimpleForm;
use LC\LobbyCore;

class EventListener implements Listener
{

    private $plugin;

    public function onJoin(PlayerJoinEvent $event)
    {

        $player = $event->getPlayer();
        $name = $player->getName();

        $event->setJoinMessage("");
        $this->plugin = LobbyCore::getInstance();
        Server::getInstance()->broadcastMessage(str_replace(["{player}"], [$player->getName()], $this->plugin->getConfig()->get("Join-Message")));
        $player->teleport(Server::getInstance()->getWorldManager()->getDefaultWorld()->getSafeSpawn());

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

    public function onQuit(PlayerQuitEvent $event){

        $player = $event->getPlayer();
        $name = $player->getName();

        $event->setQuitMessage("");
        Server::getInstance()->broadcastMessage(str_replace(["{player}"], [$name], $this->plugin->getConfig()->get("Quit-Message")));
    }
	

    public function onClick(PlayerInteractEvent $event){

        $player = $event->getPlayer();
        $itn = $player->getInventory()->getItemInHand()->getCustomName();
        if ($itn == "§r§bCosmetics") {
            LobbyCore::getInstance()->getCosmeticsUI($player);
        }
        if ($itn == "§r§cReport Player"){
            $this->plugin->getServer()->getCommandMap()->dispatch($player, "report");
        }
        if ($itn == "§r§aTeleporter") {
            LobbyCore::getInstance()->getGamesUI($player);
        }
        if ($itn == "§r§bINFO§fUI") {
            LobbyCore::getInstance()->getInfoUI($player);
        }
        if ($itn == "§r§5Lobby"){
            $this->plugin->getServer()->getCommandMap()->dispatch($player, "hub");
        }
    }
}
