<?php

namespace Verre2OuiSki\PluginTuto;

// On oublie pas les importations !
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class Ping2Command extends Command{

    /**
     * $plugin Main on passe ici notre plugin pour pouvoir utiliser certaines méthode de celui-ci dans notre commande
     */
    public function __construct( private Main $plugin ){

        // On appel ici le constructeur parent (constructeur de la class `Command`)
        parent::__construct(
            "ping", // Notre command
            "Notre première commande !", // La description de la commande
            "/ping" // L'usage de la commande
        );
        // On ajoute la permission nécessaire a l'éxecution de notre commande
        $this->setPermission("plugintuto.command.ping");
    }

    // Méthode appelée lorsqu'un utilisateur fait `/ping`
    public function execute(CommandSender $sender, string $commandLabel, array $args){

        /**
         * Ici on test si l'utilisateur a la permission de faire cette commande
         * 
         * Grace a la méthode `testPermission` de notre commande, nous pouvons tester si un utilisateur a une permission.
         * Si c'est le cas, l'éxecution de la commande continue.
         * Sinon, on retourne, ce qui va nous faire sortir de notre méthode, et par conséquent, le reste de notre code ne sera pas éxecuté.
         * 
         * De plus, elle envoi un message a l'utilisateur si  ca n'est pas le cas.
         * (Le message d'erreur peut être modifié avec `$this->setPermissionMessage($mon_message)`)
         * 
         * Je vous invite a regarde le code de la méthode `testPermission` pour en savoir plus !
         */
        if( !$this->testPermission($sender) ) return;

        // Comme dans la commande simple, on envoi a l'utilisateur le message `Pong !`
        $sender->sendMessage("Pong !");

        // Ici il n'est pas neccesaire de retourner un booléen

    }

}
