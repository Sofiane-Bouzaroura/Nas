#!/bin/bash

USERNAME=$1

# Supprimer l'utilisateur du système
userdel $USERNAME

# Supprimer le répertoire utilisateur
rm -rf /srv/nas/users/$USERNAME

# Mettre à jour la configuration SSH
sed -i "/Match User $USERNAME/,+5d" /etc/ssh/sshd_config

# Recharger le service SSH
systemctl reload sshd
