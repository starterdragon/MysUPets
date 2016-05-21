<?php

namespace pets\command;

use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pets\main;

class PetCommand extends PluginCommand {

	public function __construct(main $main, $name) {
		parent::__construct(
				$name, $main
		);
		$this->main = $main;
		$this->setPermission("pets.command");
		$this->setAliases(array("pet"));
	}

	public function execute(CommandSender $sender, $currentAlias, array $args) {
	
		if (!isset($args[0])) {
			$sender->sendMessage("Please use /pet help");
			return true;
		}
		switch (strtolower($args[0])){
			case "toggle":
				if ($sender->hasPermission('pet.command.toggle')){
				$this->main->togglePet($sender);
				return true;
				}else{$sender->sendMessage("You do not have permission to use §e/pets toggle");
					    }
				return true;
			break;
			case "name":
			case "setname":
				if (isset($args[1])){
					unset($args[0]);
					$name = implode(" ", $args);
					$this->main->getPet($sender->getName())->setNameTag($name);
					$sender->sendMessage("Set Name to ".$name);
				}
				return true;
			break;
			case "help":
				if($sender->hasPermission('pet.command.help')){
				$sender->sendMessage("§e======PetHelp======");
				$sender->sendMessage("§b/pets toggle - on/off your Pet");
				$sender->sendMessage("§b/pets type [type]");
				$sender->sendMessage("§b/pets name [petname]");
				$sender->sendMessage("§b/pets list");
				return true;
				}else{
				$sender->sendMessage("You do not have permission to use §e/pets help");
					    }
				return true;
			break;
			case "list":
				if($sender->hasPermission('pet.command.list')){
				$sender->sendMessage("§e======Pet List======");
				$sender->sendMessage("§e§ldog");
				$sender->sendMessage("§e§lblaze");
				$sender->sendMessage("§e§lpig");
				$sender->sendMessage("§e§lchicken");
				$sender->sendMessage("§e§lrabbit");
				$sender->sendMessage("§e§lmagma");
				return true;
				}else{$sender->sendMessage("§4You do not have permission to use §e/pets list");
					    }
				return true;
			break;
			case "type":
				if (isset($args[1])){
					switch ($args[1]){
						case "wolf":
						case "dog":
							if ($sender->hasPermission("pets.type.dog")){
								$this->main->changePet($sender, "WolfPet");
								$sender->sendMessage("Your pet has changed to Wolf!");
								return true;
							}else{
								$sender->sendMessage("You do not have permission for dog pet!");
								return true;
							}
						break;
						case "chicken":
							if ($sender->hasPermission("pets.type.chicken")){
								$this->main->changePet($sender, "ChickenPet");
								$sender->sendMessage("Your pet has changed to Chicken!");
								return true;
							}else{
								$sender->sendMessage("You do not have permission for chicken pet!");
								return true;
							}
						break;
						case "pig":
							if ($sender->hasPermission("pets.type.pig")){
								$this->main->changePet($sender, "PigPet");
								$sender->sendMessage("Your pet has changed to Pig!");
								return true;
							}else{
								$sender->sendMessage("You do not have permission for pig pet!");
								return true;
							}
						break;
						case "blaze":
							if ($sender->hasPermission("pets.type.blaze")){
								$this->main->changePet($sender, "BlazePet");
								$sender->sendMessage("Your pet has changed to Blaze!");
								return true;
							}else{
								$sender->sendMessage("You do not have permission for blaze pet!");
								return true;
							}
						break;
						case "magma":
							if ($sender->hasPermission("pets.type.magma")){
								$this->main->changePet($sender, "MagmaPet");
								$sender->sendMessage("Your pet has changed to Magma!");
								return true;
							}else{
								$sender->sendMessage("You do not have permission for blaze pet!");
								return true;
						break;
						case "rabbit":
							if ($sender->hasPermission("pets.type.rabbit")){
								$this->main->changePet($sender, "RabbitPet");
								$sender->sendMessage("Your pet has changed to Rabbit!");
								return true;
							}else{
								$sender->sendMessage("You do not have permission for rabbit pet!");
								return true;
							}	
							}
							}
							break;
						default:
							$sender->sendMessage("/pet type [type]");
							$sender->sendMessage("Types: blaze, pig, chicken, dog, rabbit, magma");
						return true;
					}
				}
			break;
		}
		return true;
	}

}
