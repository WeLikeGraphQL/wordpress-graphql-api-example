# wordpress-graphql-example

The aim of this repo is to work as a server side GraphQL example.

The following technologies were used at the backend:
 - WordPress - for customizing content of a website easily
 - [graphql-wp](https://github.com/tim-field/graphql-wp) - allows setting-up GraphQL endpoint in WordPress

The project can be run in a lot of ways:
 1. Vagrant - for one-command virtual server provisioning in Windows, Linux, OSX...
 2. Ansible - for one-command own server provisioning and containerizing in Linux
 3. Docker - for containerizing the application in Linux
 4. Manual - (required Apache2/Nginx, PHP >= 5.6, MySQL, Composer etc.)

We facilitate it, because we assume that not every developer will come from PHP World.

## Execution

The project publishes the following endpoints:
 - `localhost:8000/graphql` - GraphQL Endpoint
 - `localhost:8888` - PhpMyAdmin

You can customize it in `.env` file.

### 1. Vagrant (for Windows, Linux, OSX)

Vagrant makes the project executable in Windows, Linux, OSX... (as Docker is available out-of-the-box only for some Linux instances). So, if you want to set everything up automatically, then install Vagrant with this plugin:
 - `vagrant plugin install vagrant-env` # in order to store environment variables in .env file
 and just run:
 - `vagrant up --provision`

It might take some time for running the project at first, as all dependencies have to be downloaded.

If you wish to use the exemplary dataset from `mysql` folder, then:
 - vagrant ssh
 - `cd /vagrant/mysql && bash -x load_db.sh`

Caveat: You might need a superuser access, in order to perform: `bash -x load_db.sh`.

### 2. Ansible (for Linux)

If you want to use Ansible, then:
 - `ansible-playbook playbook/main.yml`

It will install the needed stuff on your host.
If you have Linux distribution that is not supported by Docker and you meet errors, then change the following part in `playbook/roles/vagrant/tasks/install.yml`:
`{{ ansible_distribution|lower}}-{{ ansible_distribution_release }}`
onto one of [supported distributions](https://docs.docker.com/engine/installation/linux/) (ubuntu-trusty, debian-wheezy etc.)

### 3. Docker (for Linux)

You can use `docker-compose` in order to set everything up and containerize automatically. You just need to execute:
 - `docker-compose up`

If you wish to use the exemplary dataset from `mysql` folder, then:
 - `cd mysql && bash -x load_db.sh`

Caveat: You might need a superuser access, in order to perform: `bash -x load_db.sh`.

### 4. Manual (for Windows, Linux, OSX)

 - cd wordpress && composer install
 - change data in `wp-config.php` according to your MySQL Server
 - copy/paste `wordpress` folder to your PHP Server

 and if you wish to fulfill database with sample data:

 - cd mysql && mysql -u<YOUR_USER_HERE> -p<YOUR_PASSWORD_HERE> < wp_backup.sql

 Caveat: change database name in `wp_backup.sql` accordingly

## Backup

If you wish to do a database backup, then:
 - `vagrant ssh` and `cd mysql && sudo bash -x backup.sh` or
 - `cd mysql && sudo bash -x backup.sh`

Remebmer to change data in `backup.sh` accordingly.

## GraphiQL

It is recommended to explore possibilities of GraphQL Endppoint. The fastest way to do it is to use:
 - [ChromeiQL](https://chrome.google.com/webstore/detail/chromeiql/fkkiamalmpiidkljmicmjfbieiclmeij)
 or
 - [GraphIQL Feen](https://chrome.google.com/webstore/detail/graphiql-feen/mcbfdonlkfpbfdpimkjilhdneikhfklp)

But you can also set up the original tool created by GraphQL Team: [GraphiQL](https://github.com/graphql/graphiql)

Screenshot from ChromeiQL:

![https://raw.githubusercontent.com/balintsera/graphql-wp/fix/no-response/.readme.md/graphiql-query.png](https://raw.githubusercontent.com/balintsera/graphql-wp/fix/no-response/.readme.md/graphiql-query.png)

## Acknowledgements
Thanks for @tim-field, who published his work: [graphql-wp](https://github.com/tim-field/graphql-wp)
