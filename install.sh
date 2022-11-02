#!/bin/bash

sudo su <<EOF
printf "APT UPDATE\n"
apt update -qq
printf "\n\nINSTALL PHP8.1 AND DEPENDENCIES\n"
apt -y -qq install php8.1 php8.1-common php8.1-bcmath openssl php8.1-mbstring php8.1-dom php8.1-curl php8.1-sqlite3
printf "\n\nINSTALL ENABLING PHP8\n"
a2dismod php7.4
a2enmod php8.1
service apache2 restart
EOF
