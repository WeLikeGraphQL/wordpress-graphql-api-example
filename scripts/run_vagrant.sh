#!/bin/bash

if ! vagrant plugin list | grep "vagrant-env"
then
    vagrant plugin install vagrant-env
fi

if ! vagrant status | grep "running"
then
    vagrant up
fi

vagrant provision

vagrant ssh -c 'cd /vagrant && sudo bash -x scripts/load_db.sh'

