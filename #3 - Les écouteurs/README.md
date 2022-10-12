# [Episode 3](video-link)
### *Créer ses premièrs écouteurs*
---

## Création d'un écouteur
---

Aujourd'hui nous allons traiter les écouteurs d'évènements.

Un écouteurs d'évènements *(listeners)*, est une procédure ou une fonction qui attend qu'un événement se produise.

Dans PocketMine-MP il éxiste de multiple évènements, telqu'un block posé, un monde généré ou encore un joueur qui nage.

---

Maintenant que nous savons ce qu'est un écouteur, nous allons en créer un.
Celui-ci écoutera les joueurs manger. On voudrait que quand il mange un steak, le message `Vous avez mangé du BEEF !` lui soit envoyé.

Pour cela, nous allons implementer dans notre class, l'interface `Listener`

Nous allons ensuite créer une méthode dans cette même class s'appellant `onPlayerItemConsume` qui prendra en parametre un évènement. Dans notre cas, celui-ci est `PlayerItemConsumeEvent`.
Puis on ajoute le code a éxecuter quand l'évènement `PlayerItemConsumeEvent` est appelé !

Ainsi, notre code devrait ressembler a ca :
```php
<?php

namespace Verre2OuiSki\PluginTuto;

// Ne pas oublier ces deux importations !
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemConsumeEvent;
use pocketmine\item\ItemIds;
use pocketmine\plugin\PluginBase;

// La class contenant des écouteurs doit implémenter l'interface `Listener`
class Main extends PluginBase implements Listener {

    // Méthode correspondant a l'écouteur de l'évènement `PlayerItemConsumeEvent`
    public function onPlayerConsum(PlayerItemConsumeEvent $event) {
        // On récupère l'item
        $item = $event->getItem();

        // On test si l'item est un steak
        if ($item->getId() !== ItemIds::COOKED_BEEF) return;

        // Récuperation du joueur acteur de l'évènement
        $player = $event->getPlayer();

        // Envoi du message
        $player->sendMessage("Vous avez mangé du BEEF !");
    }
}

```

Si nous éxecuton notre code maintenant, celui-ci ne fonctionnera pas. Pour cela, il faut renseigner notre écouteur.
Pour faire cela, il faut obtenir le gestionnaire de plugins en faisant depuis l'instance de votre plugin `$this->getServer()->getPluginManager()`.
Une fois le gestionnaire obetnu voius pouvez renseigner votre listeners en faisant `$this->getServer()->getPluginManager()->registerEvents($listener, $plugin)`

> *⚠ Ne pas confondre la méthode `registerEvents` avec `registerEvent`. Leur nom porte a confusion et cela devrait être changé dans les prochaines versions de PocketMine-MP. Si vous voulez en savoir plus sur cette confusion, je vous invite a aller voir [l'issue](https://github.com/pmmp/PocketMine-MP/issues/2796) sur le projet GitHub de PMMP*

Notre code final devrait ressembler a ceci :
```php
<?php

namespace Verre2OuiSki\PluginTuto;

// Ne pas oublier ces deux importations !
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemConsumeEvent;
use pocketmine\item\ItemIds;
use pocketmine\plugin\PluginBase;

// La class contenant des écouteurs doit implémenter l'interface `Listener`
class Main extends PluginBase implements Listener {

    public function onEnable(): void {
        // Récupération du gestionnaire de plugins et enregistrement de notre écouteur. Ici notre listener ce trouve dans la meme class que l'enregistrement, donc nous avons juste renseigner `$this` et de meme pour le plugin en second paramètre.  
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    // Méthode correspondant a l'écouteur de l'évènement `PlayerItemConsumeEvent`
    public function onPlayerConsum(PlayerItemConsumeEvent $event) {
        // On récupère l'item
        $item = $event->getItem();

        // On test si l'item est un steak
        if ($item->getId() !== ItemIds::COOKED_BEEF) return;

        // Récuperation du joueur acteur de l'évènement
        $player = $event->getPlayer();

        // Envoi du message
        $player->sendMessage("Vous avez mangé du BEEF !");
    }
}
```