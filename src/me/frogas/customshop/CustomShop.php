<?php

namespace me\frogas\customshop;

use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\{CommandSender, Command};
//download in (https://github.com/jojoe77777/FormAPI)
use jojoe77777\FormAPI\SimpleForm;
//download in (https://github.com/onebone/EconomyAPI)
use onebone\economyapi\EconomyAPI;

class CustomShop extends PluginBase implements Listener {

    public function reduceMoney(Player $player, int $amount){
        return EconomyAPI::getInstance()->reduceMoney($player, $amount);
    }

    public function addMoney(Player $player, int $amount){
        return EconomyAPI::getInstance()->addMoney($player, $amount);
    }

    public function myMoney(Player $player){
        return EconomyAPI::getInstance()->myMoney($player);
    }

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

    public function sendForm(Player $player){
        $form = new SimpleForm(function(Player $player, $data){
            $result = $data;
            if($result === null){
                return true;
            }
            if($result == 0){
                $this->sendAllShop($player);
            }
            if($result == 1){
                //
            }
            if($result == 2){
                //
            }
        });
        $form->setTitle($this->getPrefix() . " Menu");
        $form->addButton("All shop");
        $form->addButton("Search category");
        $form->addButton("Close", 0, "textures/blocks/barrier");
        $form->sendToPlayer($player);
    }

    public function sendAllShop(Player $player){
        $form = new SimpleForm(function(Player $player, $data){
            $result = $data;
            if($result === null){
                return true;
            }
            if($result == 0){
                $money = $this->myMoney($player);
                $amount = 20000;
                if($money >= $amount){
                    $this->reduceMoney($player, $amount);
                    return true;
                }
            }
        });
        $price = 20;
        $money = $this->myMoney($player);
        $form->setTitle($this->getPrefix() . " All Shop");
        $form->addButton("This is $" . $price . "000 for price");
        $form->sendToPlayer($player);
    }

}
