# ENT

url du site:

url du back-office:

a11y et Opquast: https://docs.google.com/document/d/1PFPohph-ZpYfaeToVwbtDxauVFgSzp7KarTKrvB8iQg/edit?usp=sharing 

Product Backlog: https://docs.google.com/spreadsheets/d/15kwAIlSWblKscINj0IvNKoaXvtU4EhTHo6Jdn7_WkUY/edit?usp=sharing

Audit, synthèse de la recherche utilisateur, parcours et wireframes, écrans finaux sur Figma: https://www.figma.com/design/DXEqC2LXQazsSzN1dABWee/ENT-Justine%2FLouis%2FTh%C3%A9o?node-id=0-1&t=x25qZ8bL6CNPWmec-1 

________________________________

Installation sur un serveur local :

Tout d’abord, il faut télécharger le dossier "ENT-JustineTheoLouis" contenant tous les fichiers du site et la base de données. Ensuite, il faut créer un nouveau dossier dans le dossier www de XAMPP et y déposer le fichier compressé qu'il faut extraire.

Pour ce qui est des données, il faut créer sa base de données en local et importer le fichier .sql :

- démarrer XAMPP
- aller sur http://localhost/phpmyadmin
- cliquer sur "nouvelle base de données"
- donner un nom à la base
- aller dans "importer" et choisir le fichier "ent"
- cliquer sur le bouton "importer" en bas de la page
- Si vous êtes un utilisateur de mac, modifiez la fonction  dbConnect dans "model.php" (dbname=ent;port=8889', 'root', 'root'). Une fois que la base est bien liée au site, il suffit d’y accéder avec l’adresse:

