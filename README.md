# charly-day - 10 mars 2022 - IUT Nancy-Charlemagne

## Équipe Zinzin Gang

Le défi informatique consiste en la programmation d'une application web à partir du sujet détaillé présenté au démarrage de la journée.

- Nom	: Chassard			Prénom :	Gabin	  	gpe dut : Si1
- Nom	: Cordurié			Prénom :	Lucas	  	gpe dut : Ai2
- Nom	: Grolet		  	Prénom :	Michel		gpe dut : Si1
- Nom	: Michelet			Prénom :	Alex		gpe dut : Si1
- Nom	: Steiner		  	Prénom :	Noé			gpe dut : Si1

# Informations

[Lien du test Webetu](https://webetu.iutnc.univ-lorraine.fr/~grolet4u/charly-day/)

# Clonage du site

1. Installer [composer](https://getcomposer.org/).
2. Installer [git](https://git-scm.com/).
4. Lancer dans un terminal :

```bash
git clone https://github.com/MichelGrolet/charly-day
cd charly-day
composer install
```

3. Créer un fichier de `conf.ini` pour la base de donnée dans le répertoire `src/conf` contenant :

```ini
driver = mysql
host =
database = mywishlist
username =
password =
charset = utf8
```

**Il faut remplir les champs `host`, `username` et `password` avec les informations de votre base de donnée.**
