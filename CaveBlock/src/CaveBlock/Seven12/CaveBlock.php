<?php

namespace CaveBlock\Seven12;

use CaveBlock\Seven12\Main;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\CancellableTrait;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerToggleSneakEvent;
use pocketmine\item\StringToItemParser;
use pocketmine\math\Vector3;
use pocketmine\player\GameMode;


class CaveBlock implements Listener
{
    use CancellableTrait;

    public function onBlock(BlockPlaceEvent $event)
    {

        $config = Main::getInstance()->getConfig();
        $blockID = $config->get("block", "dirt");
        $block = $event->getItem();
        $player = $event->getPlayer();
        $pos = $player->getPosition();
        $currentGameMode = $player->getGamemode();
        if($block->getTypeId() == StringToItemParser::getInstance()->parse($blockID)->getTypeId()){
            if ($currentGameMode == GameMode::SURVIVAL()) {
                $player->setGamemode(GameMode::SPECTATOR());
                $player->teleport(new Vector3($pos->getX(), $pos->getY()-2, $pos->getZ()));
                $player->sendMessage($config->get("message-entre", "§4§lSneak §2pour sortir du CaveBlock"));
                $player->setNoClientPredictions();
            }
        }
    }
    public function onSprint(PlayerToggleSneakEvent $event){

        $player = $event->getPlayer();
        $config = Main::getInstance()->getConfig();
        $currentGameMode = $player->getGamemode();
        $pos = $player->getPosition();
            if($currentGameMode == GameMode::SPECTATOR()){
                $player->teleport(new Vector3($pos->getX(), $pos->getY()+3, $pos->getZ()));
                $player->sendMessage($config->get("message-sortie", "§2Vous etes sorti du CaveBlock"));
                $player->setNoClientPredictions(false);
            }

        }
    }

