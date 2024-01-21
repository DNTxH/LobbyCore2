<?php

namespace LC;

use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\SingletonTrait;
use pocketmine\utils\TextFormat as MG;

//Events

use LC\event\EventListener;

//Commands

use LC\commands\HubCommand;

//Uis

use LC\ui\UI;

class LobbyCore extends PluginBase implements Listener
{

    use SingletonTrait;

    public function onLoad(): void
    {
        self::setInstance($this);
        parent::onLoad(); // TODO: Change the autogenerated stub
    }

    public function onEnable(): void {
        $this->getLogger()->info(MG::GREEN . "LobbyCore enabled successfully, plugin made by JuanantonioVYT");
        $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
        $this->getServer()->getCommandMap()->register("hub", new HubCommand());
        $this->saveResource("config.yml");
    }

    public function onDisable(): void {
        $this->getLogger()->info(MG::GREEN . "LobbyCore disabled successfully");
    }
}