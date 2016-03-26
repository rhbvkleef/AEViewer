# -*- mode: ruby -*-
# vi: set ft=ruby :
Vagrant.configure(2) do |config|
  config.vm.box = "ubuntu/trusty64"

  config.vm.network "forwarded_port", guest: 80, host: 8080

  # Execute when box is created
  config.vm.provision "intial",
      type: "shell",
      path: ".vagrant/provision/init.sh"

  # Execute when box is booted or reloaded
  config.vm.provision "update_apt",
      type: "shell",
      path: ".vagrant/provision/update_apt.sh",
      run: "always"
  config.vm.provision "composer_install",
      type: "shell",
      path: ".vagrant/provision/composer_install.sh",
      run: "always"
end
