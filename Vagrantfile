
Vagrant.configure("2") do |config|
    config.env.enable
    config.vm.box = "ubuntu/trusty64"

    config.vm.provider "virtualbox" do |v|
        v.customize ["modifyvm", :id, "--memory", 1500]
    end

    config.vm.network "forwarded_port", guest:ENV['PHPMYADMIN_PORT'], host:ENV['PHPMYADMIN_PORT']
    config.vm.network "forwarded_port", guest:ENV['WP_PORT'], host:ENV['WP_PORT']

    # Workaround for this bug: https://github.com/mitchellh/vagrant/issues/6793
    config.vm.provision "shell" do |s|
        s.inline = '[[ ! -f $1 ]] || grep -F -q "$2" $1 || sed -i "/__main__/a \\    $2" $1'
        s.args = ['/usr/bin/ansible-galaxy', "if sys.argv == ['/usr/bin/ansible-galaxy', '--help']: sys.argv.insert(1, 'info')"]
    end

    config.vm.provision "ansible_local" do |ansible|
        ansible.playbook = "playbook/main.yml"
        ansible.verbose = "vvv"
        ansible.install = true
    end
end