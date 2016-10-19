#!/bin/bash

# Run this script from the project root folder:
# bash -x scripts/add_to_plugin.sh

if ! grep -Fxq "require_once __DIR__.\"/../../../vendor/autoload.php\";" wordpress/wp-content/plugins/graphql-wp/index.php
then
  sed -i '/namespace Mohiohio\\GraphQLWP;/a require_once __DIR__."/../../../vendor/autoload.php";' wordpress/wp-content/plugins/graphql-wp/index.php
fi