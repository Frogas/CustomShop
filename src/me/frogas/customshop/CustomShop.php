<?php

namespace me\frogas\customshop;

use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\{CommandSender, Command};
//download in (https://github.com/jojoe77777/FormAPI
use jojoe77777\FormAPI\SimpleForm;
//download in (https://github.com/onebone/EconomyAPI
use onebone\economyapi\EconomyAPI;

class CustomShop extends PluginBase implements Listener {

    public function onEnable(){
        $this->getServer()->getLogger()->info("Loaded Plugin");
    }

    public function onCommand(CommandSender $player, Command $cmd, string $label, array $args) : bool {
        if($player instanceof Player){
            if($cmd->getName() == "cshop"){
                $this->sendForm($player);
            }
        }
    }

    public function sendForm($player){
        $form = new SimpleForm(function(Player $player, $data){
            $result = $data;
            if($result === null){
                return true;
            }
            if($result == 0){
                //
            }
            if($result == 1){
                //
            }
            if($result == 2){
                //
            }
        });
        $form->setTitle("[CS] > Menu");
        $form->addButton("All shop");
        $form->addButton("Search category");
        $form->addButton("Close", 0, "textures/blocks/barrier");
        $form->sendToPlayer($player);
    }

}
