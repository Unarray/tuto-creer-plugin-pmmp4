# [Episode 1](https://youtu.be/-xrd_uZzV8I)
### *Comment créer un plugin PocketMine-MP ?*

---

## Prérequis :

* Connaitre un minimum le langage PHP [*(Si ce n'est pas le cas, suivre les cours de Grafikart)*](https://www.youtube.com/playlist?list=PLjwdMgw5TTLVDv-ceONHM_C19dPW1MAMD)
* Avoir un éditeur de textes *(Visual Studio Code, PhpStorm, NotePad++, bloc note, etc...)*
* [Avoir installé un serveur **PocketMine-MP**](https://doc.pmmp.io/en/rtfd/installation.html)
* [Avoir le plugin **PocketMine-DevTools** *(permet exécution de notre code sans avoir a le mettre en `.phar`)*](https://poggit.pmmp.io/p/DevTools)

---

## Création du plugin

Notre plugin sera sous l'API 4.0.0 de PocketMine-MP

Celui-ci sera nommé `PluginTuto` 

### Structure de base

Il y a 2 éléments principaux :
* Un fichier `plugin.yml`
    > Contient des informations sur le plugin
* Le fichier principal de notre plugin, `Main.php` 

Ainsi, voici à quoi ressemblera le squelette de notre plugin :
```
MonPlugin/
├── src/
│   └── Verre2OuiSki/
│       └── PluginTuto/
│           └── Main.php
└── plugin.yml
```

### Création du [`plugin.yml`](https://buildmedia.readthedocs.org/media/pdf/pmmp/rtfd/pmmp.pdf#section.15.5)
Dans ce fichier, vous devrez obligatoirement renseigner les 4 clés suivantes :

> * [name](https://buildmedia.readthedocs.org/media/pdf/pmmp/rtfd/pmmp.pdf#subsubsection*.54)
> * [version](https://buildmedia.readthedocs.org/media/pdf/pmmp/rtfd/pmmp.pdf#subsubsection*.55)
> * [api](https://buildmedia.readthedocs.org/media/pdf/pmmp/rtfd/pmmp.pdf#subsubsection*.57)
> * [main](https://buildmedia.readthedocs.org/media/pdf/pmmp/rtfd/pmmp.pdf#subsubsection*.56)

Ainsi, chacun de vos plugins devront avoir ces quatre éléments :
```yaml
---

name: PluginTuto
version: 1.0.0
api: 4.0.0
main: Verre2OuiSki\PluginTuto\Main

...
```

## Création de notre fichier principal
Comme montré plus haut, notre fichier principal se situe dans `src/Verre2OuiSki/PluginTuto/` et est nommé `Main.php`

Ce fichier va être le fichier exécuté au lancement de notre plugin.
```php
<?php

// Namespace de notre fichier (correspond aux dossier dans lequel ce fichier est situé depuis "src")
namespace Verre2OuiSki\PluginTuto;

// "Importation" de la class `PluginBase`
use pocketmine\plugin\PluginBase;

// Création de notre class `Main` héritant des propriétés et méthodes de la class `PluginBase`
class Main extends PluginBase{
    // Votre code (Voir épisode deux)
}
```

---

## [src-namespace-prefix](https://buildmedia.readthedocs.org/media/pdf/pmmp/rtfd/pmmp.pdf#paragraph*.75)

Comme vous avez pu le voir, le squelette de notre plugin comporte une section inutile. Les dossiers `Verre2OuiSki` et `PluginTuto` ne servent a rien à part respecter notre namespace. 

Pour remédier à ce problème, PocketMine-MP v4.0.0 nous permette désormais de supprimer ces dossiers imbriqués, et les remplacer par un prefix pour nos espaces de noms.

Pour pouvoir supprimer ces dossiers, vous devrez ajouter dans votre `plugin.yml` la clé facultative `src-namespace-prefix`. Elle vous permettra de respecter votre espace de nom sans avoir a créer des dossiers imbriqués.
Ainsi, votre `plugin.yml` devrait ressembler a ça :
```yaml
---

name: PluginTuto
version: 1.0.0
api: 4.0.0
main: Verre2OuiSki\PluginTuto\Main

src-namespace-prefix: Verre2OuiSki\PluginTuto

...
```

Pour vous montrer l'utilité de cette clé, voici un avant/après

#### **Sans `src-namespace-prefix` :**
```
MonPlugin/
├── src/
│   └── Verre2OuiSki/
│       └── PluginTuto/
│           └── Main.php
└── plugin.yml
```
```yaml
---
name: PluginTuto
version: 1.0.0
api: 4.0.0
main: Verre2OuiSki\PluginTuto\Main
...
```

#### **Avec `src-namespace-prefix` :**
```
MonPlugin/
├── src/
│   └── Main.php
└── plugin.yml
```
```yaml
---
name: PluginTuto
version: 1.0.0
api: 4.0.0
main: Verre2OuiSki\PluginTuto\Main
src-namespace-prefix: Verre2OuiSki\PluginTuto
...
```
---
### Pour vous faire un exemple un peu plus exagéré :

#### **Sans :**
```
MonPlugin/
├── src/
│   └── Youtube/
│       └── Verre2OuiSki/
│           └── Tutoriel/
│               └── PocketMineMP/
│                   └── CreerUnPlugin/
│                       └── PluginTuto/
│                           └── Main.php
└── plugin.yml
```
```yaml
---
name: PluginTuto
version: 1.0.0
api: 4.0.0
main: Youtube\Verre2OuiSki\Tutoriel\PocketMineMP\CreerUnPlugin\PluginTuto\Main
...
```

#### **Avec :**
```
MonPlugin/
├── src/
│   └── Main.php
└── plugin.yml
```
```yaml
---
name: PluginTuto
version: 1.0.0
api: 4.0.0
main: Youtube\Verre2OuiSki\Tutoriel\PocketMineMP\CreerUnPlugin\PluginTuto\Main
src-namespace-prefix: Youtube\Verre2OuiSki\Tutoriel\PocketMineMP\CreerUnPlugin\PluginTuto
...
```
---

## Quelques documentations :

* [Apprendre le PHP](https://www.youtube.com/playlist?list=PLjwdMgw5TTLVDv-ceONHM_C19dPW1MAMD)
* [Gestion sémantique de version 2.0.0 | Semantic Versioning](https://semver.org/lang/fr/)
* [Règles POGGIT](https://poggit.pmmp.io/rules.edit)
* [Doc PDF de PocketMine](https://buildmedia.readthedocs.org/media/pdf/pmmp/rtfd/pmmp.pdf)
* [Code Source de PocketMine-MP](https://github.com/pmmp/PocketMine-MP/)
* [Doc de l'API](https://apidoc.pmmp.io/)
* [Discord PocketMine-MP Community](https://discord.com/invite/bmSAZBG)

---
