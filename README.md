# wordpress-graphql-example

The aim of this repo is to work as a server side GraphQL example.

The following technologies were used at the backend:
 - [WordPress](https://wordpress.org/download/) - for customizing content of a website easily
 - [graphql-wp](https://github.com/tim-field/graphql-wp) - allows setting-up GraphQL endpoint in WordPress

## Execution

The project can be run using one of the following (what is convenient for you):
 1. [Vagrant](https://www.vagrantup.com/) - for one-command virtual server provisioning in Windows, Linux, OSX... (the best option when Ansible/Docker not installed). Requirements: *Vagrant >=1.8*
 
 2. [Ansible](https://www.ansible.com/) - for one-command own server provisioning and containerizing in Linux (the best option when Docker not installed). Requirements: *ansible-playbook*
 
 3. [Docker](https://www.docker.com/) - for containerizing the application in Linux. Requirements: *docker*, *docker-compose*, *[composer](https://getcomposer.org/)*
 
 4. Manually - (any OS, required Apache2/Nginx, PHP >= 5.6, MySQL, Composer etc.)

We facilitate it, because we assume that not every developer will come from PHP World.

The project publishes the following endpoints:
 - `localhost:8000/graphql` - GraphQL Endpoint
 - `localhost:8888` - PhpMyAdmin

You can customize it in `.env` file.

### 1. Vagrant (for Windows, Linux, OSX)

Vagrant makes the project executable in Windows, Linux, OSX... (as Docker is available out-of-the-box only for [some Linux instances](https://docs.docker.com/engine/installation/linux/)). So, if you want to set everything up automatically, then install both [Vagrant](https://www.vagrantup.com/) and [this plugin](https://github.com/gosuri/vagrant-env), and finally invoke:

 - `vagrant up`
 - `vagrant provision`

It might take some time for running the project at first, as all dependencies have to be downloaded.

If you wish to use the exemplary dataset from `mysql` folder, then invoke:
 - `vagrant ssh`
 - `cd /vagrant/mysql && bash -x load_db.sh`

Caveat: You might need a superuser access, in order to perform: `bash -x load_db.sh`.

### 2. Ansible (for Linux)

If you do not have Docker installed, then you can install everything using [Ansible](https://www.ansible.com/). Invoke:

`ansible-playbook main.yml`

It will install the needed stuff on your host.

If you have Linux distribution that is not supported by Docker and it causes errors, then change the following part in `roles/vagrant/tasks/install.yml`:

`{{ ansible_distribution|lower}}-{{ ansible_distribution_release }}`

onto one of [supported distributions](https://docs.docker.com/engine/installation/linux/) (`ubuntu-trusty`, `debian-wheezy` etc.)

### 3. Docker (for Linux)

You can use [Docker Compose](https://docs.docker.com/compose/) in order to set everything up and containerize automatically. You just need to execute:

 - `docker-compose up`
 - `cd wordpress && composer install`

and if [this PR](https://github.com/tim-field/graphql-wp/pull/9) is not merged, add:
 ```php
 require_once __DIR__.'/../../../vendor/autoload.php';
 ```
after `namespace Mohiohio\GraphQLWP;` in `wordpress/wp-content/plugins/graphql-wp/index.php`.

If you wish to use the exemplary dataset from `mysql` folder, then:

`cd mysql && bash -x load_db.sh`

Caveat: You might need a superuser access, in order to perform: `bash -x load_db.sh`.

### 4. Manually (for Windows, Linux, OSX)

 - `cd wordpress && composer install`
 - change data in `wp-config.php` according to your MySQL Server
 - and if [this PR](https://github.com/tim-field/graphql-wp/pull/9) is not merged, add:
 
    ```php
    require_once __DIR__.'/../../../vendor/autoload.php';
    ```
    
   after `namespace Mohiohio\GraphQLWP;` in `wordpress/wp-content/plugins/graphql-wp/index.php`.
 - copy/paste `wordpress` folder to your PHP Server

 and if you wish to fulfill database with sample data:

 - `cd mysql && mysql -u<YOUR_USER_HERE> -p<YOUR_PASSWORD_HERE> < wp_backup.sql`

 Caveat: change database name in `wp_backup.sql` accordingly.

## Backup

If you wish to do a database backup, then execute one of the following:
 - `vagrant ssh` and `cd mysql && sudo bash -x backup.sh`
 - `cd mysql && sudo bash -x backup.sh`

Remebmer to change data in `backup.sh` accordingly.

## GraphiQL

It is recommended to explore possibilities of GraphQL Endppoint. The fastest way to do it is to use one of the following solutions:
 - [ChromeiQL](https://chrome.google.com/webstore/detail/chromeiql/fkkiamalmpiidkljmicmjfbieiclmeij)
 - [GraphIQL Feen](https://chrome.google.com/webstore/detail/graphiql-feen/mcbfdonlkfpbfdpimkjilhdneikhfklp)

But you can also set up the original tool created by GraphQL Team: [GraphiQL](https://github.com/graphql/graphiql)

Screenshot from ChromeiQL:

![https://raw.githubusercontent.com/balintsera/graphql-wp/fix/no-response/.readme.md/graphiql-query.png](https://raw.githubusercontent.com/balintsera/graphql-wp/fix/no-response/.readme.md/graphiql-query.png)

## Acknowledgements
Thanks for @tim-field, who published his work: [graphql-wp](https://github.com/tim-field/graphql-wp)
