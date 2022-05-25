<?php

namespace Verre2OuiSki\PluginTuto;

// Ne pas oublier ces deux importations !
use pocketmine\command\CommandSender; 
use pocketmine\command\Command;

use pocketmine\plugin\PluginBase;

class Main extends PluginBase{


    public function onEnable() : void {
        
    }

    /**
     * La methode a implémenter, il faut qu'elle est la meme    signature que la class parent (ici PluginBase)
     * @param CommandSender $sender la personne ayant éxecuté la commande
     * @param Command $command la command ayant été executé
     * @param string[] $args un tableau des arguments passés après la commande
     * @param string $label correspond a ce que l'utilisateur a entré
     *  exemple : "/ping", "/pg", "/bonjour", etc...
     */
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{

        // On récupère le nom de la commande
        $cmd_name = $command->getName();

        switch( $cmd_name ){

            // Si le nom de la commande est égal a `ping`, alors le code situé entre `case "ping":` et `break;` sera éxecuté
            case "ping":

                // On envoi a l'envoyeur le message "Pong !"
                $sender->sendMessage("Pong !");

                // Notre commande a bien été éffectué, on retourne donc `true`
                return true;

            break;

            // Le code sera éxecuté entre `default` et `break` si aucun de nos cas n'a été traité
            default:

                //  Comme rien ne s'est passé, on retourne false
                return false;

            break;
        }
    }

}