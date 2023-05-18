{\rtf1\ansi\ansicpg1252\cocoartf2709
\cocoatextscaling0\cocoaplatform0{\fonttbl\f0\froman\fcharset0 Times-Roman;\f1\fmodern\fcharset0 Courier;}
{\colortbl;\red255\green255\blue255;\red0\green0\blue0;}
{\*\expandedcolortbl;;\cssrgb\c0\c0\c0;}
{\*\listtable{\list\listtemplateid1\listhybrid{\listlevel\levelnfc0\levelnfcn0\leveljc0\leveljcn0\levelfollow0\levelstartat1\levelspace360\levelindent0{\*\levelmarker \{decimal\}}{\leveltext\leveltemplateid1\'01\'00;}{\levelnumbers\'01;}\fi-360\li720\lin720 }{\listname ;}\listid1}}
{\*\listoverridetable{\listoverride\listid1\listoverridecount0\ls1}}
\paperw11900\paperh16840\margl1440\margr1440\vieww11520\viewh8400\viewkind0
\deftab720
\pard\tx220\tx720\pardeftab720\li720\fi-720\sa240\partightenfactor0
\ls1\ilvl0
\f0\fs24 \cf0 {\listtext	1	}\expnd0\expndtw0\kerning0
Visitez mon profil Github et t\'e9l\'e9chargez le projet \'e0 l'URL suivante : 
\f1\fs26 https://github.com/ParasmoM/Saint_laurent_projet_bien-etre
\f0\fs24 .\
\pard\tx220\tx720\pardeftab720\li720\fi-720\sa240\partightenfactor0
\ls1\ilvl0\cf0 \kerning1\expnd0\expndtw0 {\listtext	2	}\expnd0\expndtw0\kerning0
Suite au t\'e9l\'e9chargement, d\'e9compressez le projet (s'il est zipp\'e9) dans le r\'e9pertoire de votre choix sur votre ordinateur. Si vous utilisez Git, vous pouvez aussi cloner directement le d\'e9p\'f4t dans votre r\'e9pertoire local en utilisant la commande 
\f1\fs26 git clone
\f0\fs24 , suivie de l'URL du d\'e9p\'f4t.\
\ls1\ilvl0\kerning1\expnd0\expndtw0 {\listtext	3	}\expnd0\expndtw0\kerning0
Une fois le projet plac\'e9 dans le r\'e9pertoire de votre choix, ouvrez une fen\'eatre de terminal \'e0 cet emplacement. Il vous faut \'e0 pr\'e9sent installer les d\'e9pendances n\'e9cessaires pour le fonctionnement de l'application. Pour ce faire, lancez la commande 
\f1\fs26 composer install
\f0\fs24 .\
\ls1\ilvl0\kerning1\expnd0\expndtw0 {\listtext	4	}\expnd0\expndtw0\kerning0
Acc\'e9dez au fichier .env afin de configurer le DATABASE_URL. Commencez par s\'e9lectionner le syst\'e8me de gestion de base de donn\'e9es que vous pr\'e9f\'e9rez, id\'e9alement MySQL. Indiquez ensuite vos identifiants et l'URL de votre phpMyAdmin, puis attribuez un nom \'e0 votre base de donn\'e9es. En suivant correctement ces \'e9tapes, vous devriez obtenir quelque chose ressemblant \'e0 ceci : DATABASE_URL="mysql://root:root@127.0.0.1:8889/nom_de_votre_base_de_donnees?serverVersion=8&charset=utf8mb4".\
\ls1\ilvl0\kerning1\expnd0\expndtw0 {\listtext	5	}\expnd0\expndtw0\kerning0
Lancez la commande suivante pour cr\'e9er la base de donn\'e9es : php bin/console doctrine:database:create.\
\ls1\ilvl0\kerning1\expnd0\expndtw0 {\listtext	6	}\expnd0\expndtw0\kerning0
Procurez-vous le fichier SQL pour l'importer dans phpMyAdmin.\
\ls1\ilvl0\kerning1\expnd0\expndtw0 {\listtext	7	}\expnd0\expndtw0\kerning0
Normalement, la base de donn\'e9es est d\'e9j\'e0 pr\'e9remplie de donn\'e9es factices pour les tests. Toutefois, si ce n'est pas le cas, la commande "symfony console doctrine:fixtures:load" produira une nouvelle base de donn\'e9es remplie de donn\'e9es factices cr\'e9\'e9es par Fixtures et Faker.\
}