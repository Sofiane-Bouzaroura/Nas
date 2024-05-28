#!/bin/bash

USERNAME=$1
DIRECTORY=$2

# Créer un répertoire utilisateur
mkdir - /srv/nas/users/$USERNAME

# Ajouter un utilisateur au système
useradd -d /srv/nas/users/$USERNAME -s /bin/false $USERNAME

# Attribuer les autorisations appropriées
chown root:root /srv/nas/users/$USERNAME
chmod 755 /srv/nas/users/$USERNAME

# Mettre à jour la configuration SSH
echo "
Match User $USERNAME
   ChrootDirectory /srv/nas/users/$USERNAME
   ForceCommand internal-sftp
   AllowTcpForwarding no
   X11Forwarding no
" >> /etc/ssh/sshd_config

# Recharger le service SSH
systemctl reload sshd