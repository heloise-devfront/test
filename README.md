# Configuration de la machine et lancement du test

Cette installation vaut pour Linux Ubuntu

Mise à jour des paquets
###          
    sudo apt-get update

Installation de Apache2
###          
    sudo apt-get install -y apache2

Installation Mysql
###          
    sudo apt-get install mysql-server

Installation de PHP
###          
    sudo apt-get install -y php7.2 php7.2-fpm libapache2-mod-php7.2 php7.2-curl php7.2-json php-memcached php7.2-xml php7.2-mbstring php-imagick php7.2-gd php7.2-soap php7.2-mysql

Application des modifications pour Apache2
###
    sudo a2enmod actions alias fastcgi rewrite headers
    sudo a2enmod proxy proxy_fcgi
    sudo a2enconf php7.2-fpm
    sudo service apache2 restart
    sudo apt-get update

Installation de NodeJs et yarn
###          
    curl -sL https://deb.nodesource.com/setup_10.x
    sudo bash -
    curl -sL https://dl.yarnpkg.com/debian/pubkey.gpg
    sudo apt-key add -
    sudo tee /etc/apt/sources.list.d/yarn.list
    sudo apt-get update
    sudo apt-get install -y build-essential libssl-dev nodejs libpng-dev yarn libfontconfig
    sudo npm install -g gulp

A partir de maintenant pour appliquer les commandes, je pars du dossier racine du projet (celui dans lequel vous avez installer le projet)

Création de l'utilisateur Mysql, database et restore de la table
###          
    sudo mysql
    GRANT ALL PRIVILEGES ON *.* TO 'dev'@'localhost' IDENTIFIED BY 'mysql';
    \q
    mysql -u dev -p
    CREATE DATABASE test;
    SHOW DATABASES;
    \q
    mysql -u dev -p test < dump.sql

Vérification
###
    mysql -u dev -p mysql
    use test
    SELECT * FROM cars;
    SELECT * FROM provider;

 Lancement sur serveur Php
###          
    php  -S 0.0.0.0:8083 -t.

Installation des modules et lancement de Yarn
###
    cd test/src
    yarn install
    yarn start

À réaliser lors du test :
- definir une approche UX efficace
- construire une interface responsive
- pouvoir créer une nouvelle marque,
- pouvoir créer de nouveaux véhicules.
- Éditer les véhicules existants, 
- pouvoir les supprimer.

le composant React présenté est là pour avoir une base fonctionnelle, vous n'êêtes pas obligé de le garder.
Le but du present test n'est pas de tout faire, parfaitement, mais de vous permettre de vous situer, graphiquement, en algorithmique front, et/ou en back
Merci de noter la durée que vous y consacrerez, ainsi que les éléments qui vous ont le plus posé de soucis, ceux que vous avez réalisé avec le plus de plaisir ^^

Enjoy !
