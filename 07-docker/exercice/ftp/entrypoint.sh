#!/bin/bash

# Crée l'utilisateur FTP
useradd -h /home/ftpusers/benjamin -D benjamin
echo "benjamin:monsupermotdepasse" | chpasswd

# Définir la plage de ports passifs
echo "30000 30009" > /etc/pure-ftpd/passive_ports

# Lancer le serveur FTP
exec pure-ftpd \
  -c 5 \
  -C 5 \
  -l unix \
  -E \
  -j \
  -R \
  -P 127.0.0.1 \
  --passiveportrange 30000:30009
