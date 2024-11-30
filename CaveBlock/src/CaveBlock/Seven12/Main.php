<?php

namespace CaveBlock\Seven12;

use CaveBlock\Seven12\CaveBlock;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\SingletonTrait;


class Main extends PluginBase implements Listener{

    use SingletonTrait;

    public function onEnable():void{
        self::setInstance($this);

        $this->saveDefaultConfig();

        Server::getInstance()->getPluginManager()->registerEvents(new CaveBlock(),$this);
    }
}
