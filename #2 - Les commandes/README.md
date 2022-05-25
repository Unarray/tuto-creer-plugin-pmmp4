# [Episode 2](video-link)
### *Créer ses premières commandes*
---

## PARTIE 1
### Création d'une commande simple
---

Nous avons vu dans le dernière épisode le fichier `plugin.yml`

Je vous avais donné une documentation PDF contenant les différentes clés possibles de ce fichier.

Certaines de ces clés vont nous être utiles pour créer nos commandes !

Si vous reprenez la documention et vous rendez dans la section [Plugin manifest fields](https://buildmedia.readthedocs.org/media/pdf/pmmp/rtfd/pmmp.pdf#section.15.5).
Vous pourrez trouver les clés [permissions](https://buildmedia.readthedocs.org/media/pdf/pmmp/rtfd/pmmp.pdf#paragraph*.74) et [commands](https://buildmedia.readthedocs.org/media/pdf/pmmp/rtfd/pmmp.pdf#paragraph*.73).
Je vous invite a regarder ce que premennent ces deux clés en valeurs pour pouvoir continuer.

Après avoir lu la documentation, nous allons maintenant créer notre commande !
Cette commande sera `/ping` *(avec un alias `/pg`)* qui nous envera le message `Pong !`.
Pour éxecuter celle-ci nous devrons disposer de la permission `plugintuto.command.ping`. Cette permission sera activé par defaut aux joueurs étant OPERATEUR.

Ainsi, notre fichier `plugin.yml` devrait ressembler a ceci :
```yaml
---

name: PluginTuto
version: 1.0.0
api: 4.0.0
main: Verre2OuiSki\PluginTuto\Main
src-namespace-prefix: Verre2OuiSki\PluginTuto

permissions:
  plugintuto.command.ping:
    default: op
    description: Permission de la commande "ping"

commands:
    # A noter que les clés permission-message, aliases et usage sont facultatives 
  ping:
    description: Notre première commande !
    usage: /ping
    aliases:
      - pg
    permissions: monplugin.command.ping
    permission-message: Vous n'avez pas la permission de faire cette commande !

...
```

Une fois notre commandes enregistrée, il faut maintenant créer le code qui sera éxecuté lorsque la commande est envoyé.
> Pour rappel, notre commande envera le message `Pong !` a l'utilisateur.

Pour faire cela, rendons-nous dans notre fichier `Main.php` et implémentons la méthode `onCommand` 
```php
<?php

namespace Verre2OuiSki\MonPlugin;

// Ne pas oublier ces deux importations !
use pocketmine\command\CommandSender; 
use pocketmine\command\Command;

use pocketmine\plugin\PluginBase;

class Main extends PluginBase{


    /**
     * La methode a implémenter, il faut qu'elle est la meme    signature que la class parent (ici PluginBase)
     * $sender CommandSender la personne ayant éxecuté la commande
     * $command Command la command ayant été executé
     * $args array un tableau des arguments passés après la commande
     * $label string correspond a ce que l'utilisateur a entré
     * exemple : "/ping", "/pg", "/bonjour", etc...
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
```

Notre commande est maintenant fonctionnelle. Les joueurs possedant la permission ayant été OP, pourront l'éxecuter !

---

# PARTIE 2
## Création d'une commande dans un fichier externe.
---

Nous avons vu comment créer une commande simple. Cette méthode peut être pratique lors de petit projet ne nécessitant que peu de commande n'éxecutant pas énormement de code.

Mais on peut aussi les créer a l'exterieur de notre fichier `Main.php`. Cela nous permettra de garder un projet structuré et propre. Surtout si nous avons pas mal de commandes.

Assez parlé c'est l'heure de coder !

Avec cette deuxième methode, vous pouvez dans votre fichier `plugin.yml` supprimer la clés `commands`. Elle ne nous est plus d'aucunes utilités.

Dans notre dossier source *(`src/`)* nous allons créer un nouveau fichier nommé `PingCommand.php`.
Ce fichier contiendra notre commande `/ping`

```php
<?php

declare(strict_types=1);

namespace Verre2OuiSki\PluginTuto;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

// On créer une class `PingCommand` qui étand la class `Command`
class PingCommand extends Command{

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

        // Faire le test de permission

        // Comme dans la commande simple, on envoi a l'utilisateur le message `Pong !`
        $sender->sendMessage("Pong !");

        // Ici il n'est pas neccesaire de retourner un booléen

    }

}
```
