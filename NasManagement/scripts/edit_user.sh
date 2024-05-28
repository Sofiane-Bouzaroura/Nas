#! /bin/bash

OLD_USERNAME=$1
NEW_USERNAME=$2
DIRECTORY=$3

# Mettre à jour l'utilisateur dans le système
usermod -l $NEW_USERNAME -d /srv/nas/users/$NEW_USERNAME -m $OLD_USERNAME

# Mettre à jour le répertoire
mv /srv/nas/users/$OLD_USERNAME /srv/nas/users/$NEW_USERNAME

# Attribuer les autorisations appropriées
chown root:root /srv/nas/users/$NEW_USERNAME
chmod 755 /srv/nas/users/$NEW_USERNAME

# Mettre à jour la configuration SSH
sed -i "s/Match User $OLD_USERNAME/Match User $NEW_USERNAME/" /etc/ssh/sshd_config
sed -i "s/\/srv\/nas\/users\/$OLD_USERNAME/\/srv\/nas\/users\/$NEW_USERNAME/" /etc/ssh/sshd_config

# Recharger le service SSH
systemctl reload sshd