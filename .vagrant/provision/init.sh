#!/bin/bash
#Don't be interactive please.
export DEBIAN_FRONTEND=noninteractive

# Update and upgrade
sudo apt-get update
sudo apt-get upgrade -y

# Add php-5.6 repository.
sudo apt-get install python-software-properties
sudo add-apt-repository ppa:ondrej/php <<EOF

EOF
sudo apt-get update

# Install apache2, php5,
sudo -E apt-get -q -y install apache2 php5.6 libapache2-mod-php5.6 mysql-server-5.5 php5.6-mcrypt php5.6-cli php5.6-common php5.6-mysql php5.6-sqlite php5.6-mbstring php5.6-xml

# Create forge database
mysql -u root -e "CREATE DATABASE forge;"

# Are there any better ways to do this?
mysqladmin -u root password laravel

#-------------------------------------------------------------------------------
#---------- Rewrite the 000-default.conf to point to /vagrant/public -----------
#-------------------------------------------------------------------------------
#Empty 000-default.conf
sudo -- bash -c '> /etc/apache2/sites-enabled/000-default.conf'

function toFile {
    cat <<EOF > /etc/apache2/sites-enabled/000-default.conf
    <VirtualHost *:80>
        ServerAdmin rhbvkleef@gmail.com
        DocumentRoot /vagrant/public

        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined
    </VirtualHost>
EOF
}

DECTOFILE=`declare -f toFile`
sudo bash -c "$DECTOFILE; toFile"

#-------------------------------------------------------------------------------
#---------------- Modify apache config to add vagrant directory ----------------
#-------------------------------------------------------------------------------
function appendApacheConfig {
    echo '<Directory /vagrant/>' >> /etc/apache2/apache2.conf
    echo '  Options +Indexes +FollowSymLinks' >> /etc/apache2/apache2.conf
    echo '  AllowOverride All' >> /etc/apache2/apache2.conf
    echo '  Require all granted' >> /etc/apache2/apache2.conf
    echo '</Directory>' >> /etc/apache2/apache2.conf
}

DECAPPENDCFG=`declare -f appendApacheConfig`
sudo bash -c "$DECAPPENDCFG; appendApacheConfig"
#-------------------------------------------------------------------------------

cd /vagrant

# Install composer and initialize laravel, classloader and migration.
php composer.phar install
php artisan migrate

# Add mod_rewrite to apache2 for pretty URLs
sudo a2enmod rewrite

# Finally restart apache2! Now enjoy.
sudo service apache2 restart
