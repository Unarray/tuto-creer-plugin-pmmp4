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
