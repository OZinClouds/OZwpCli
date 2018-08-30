# OZwpCli
Simple Admin Panel for creating sandbox Wordpress and WP development plugs for altering admin settings using WP-CLI with PHP.

## Features
* [WP-CLI](http://wp-cli.org) with PHP
	* Find all WP installations in root
	* Update WP core and plugins
	* Create WP sandbox with your default settings
	* Edit WP with your default settings (config, options, plugins, themes and user)
* Bootstrap 4 with [Start Bootstrap - SB Admin Template](https://startbootstrap.com/template-categories/all/)
* Jquery everywhere with ajax calls to WP-CLI
* Fontawesome, Sweetalert2,  busy-load, tablesorter
* Bundled and browser-synced with Webpack 
* Composer for parsedown, phpdotenv and php-array-group-by

## Installation

 Clone or download from Github.

to build the webpack bundle:

	$ npm run
to build with webpack and run in safari with BrowserSync + HotModuleReplacement (_for chrome replace safari with chrome_):

	$ npm run safari 


### assumptions
 - Localhost is the Root directory of all your WP installs
 - There is at least one WP installation in the Root
 - You will install all new WP sites in the Root directory
 - You have the pre-requisites as described below

### pre-requisites:
This app runs only in Mac with cli commands executed by Terminal.app.

basically, you need to:

 1. Setup export $PATH variables, esp. if you're running **MAMP**.
 2. Install the latest version of **npm** and run install in the app directory.
 3. Install the latest version of **composer** *_(recommended globally)_* and run install in the app directory.
 4. Install the latest version of **wp-cli** *_(recommended globally)_*.

#### MAMP setup
If you're running PHP on MAMP, a **_.bash_profile_** adjustment needed. Exporting Path as best practice is as below. You may copy and paste these settings in your file. I am running MAMP version 5.6.31. But any version is extracted by the script.
```
### MAMP version (5.6.31)
##  ls /Applications/MAMP/bin/php/ | sort -n | tail -2 | head -1
## /Applications/MAMP/bin/php/php5.6.31/bin
## export PATH=/Applications/MAMP/Library/bin:$PATH
PHP_VERSION=$(ls /Applications/MAMP/bin/php/ | sort -n | tail -2 | head -1)
export PATH=/Applications/MAMP/bin/php/${PHP_VERSION}/bin:$PATH
```
You can echo your PATH by `$ echo $PATH` in your Terminal window. This path info will be crucial for running wp-cli commands. Please copy and save this path info in your **_.env_** file.

#### npm
You need npm to install all dependencies, including composer.
Since you're on a Mac environment, you have probably a version of npm + node installed in your system. For updating your versions and further upgrading options, please visit [docs.nmpjs.com](https://docs.npmjs.com/getting-started/installing-node)

For the dependencies listed in package.json, run `$ npm install` in your admin folder with Terminal.app

******
#### composer
Composer can be installed by the instructions in its site [getcomposer.org](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx) and I highly recommend to install it **Globally**.

Composer dependencies are hooked in config.php. To install and create the vendor folder, in your Terminal.app (and of course in the install directory of the app) run `$ composer install` .
*****
#### wp-cli
Installing wp-cli is well documented in its site: [wp-cli](https://wp-cli.org/#installing). If you're lucky with previous installs of npm and composer, this will run like a charm.

#### wp-cli / packages
OZwpCli uses packages from wp-cli, which you may find the index of packages here: [wp-cli/packages](http://wp-cli.org/package-index/).
##### wp-cli/find-command
Find WordPress installations on the filesystem.
###### Installation:
    $ wp package install wp-cli/find-command
You may encounter memory problems and you can find solutions [here](https://make.wordpress.org/cli/handbook/common-issues/#php-fatal-error-allowed-memory-size-of-999999-bytes-exhausted-tried-to-allocate-99-bytes). Script below works for me:

    $ php -d memory_limit=512M "$(which wp)" package install wp-cli/find-command
*****
##### wp-cli/admin-command
Opens wp-admin in default browser
###### Installation:
    $ wp package install wp-cli/admin-command
You may encounter memory problems and you can find solutions [here](https://make.wordpress.org/cli/handbook/common-issues/#php-fatal-error-allowed-memory-size-of-999999-bytes-exhausted-tried-to-allocate-99-bytes). Script below works for me:

    $ php -d memory_limit=650M "$(which wp)" package install wp-cli/admin-command
*****
## dotenv - site settings
- config.php immediately creates a **_.env_** file in the root folder from a sample.env file.
  - **EXPORT_PATH**
  this environmental variable should be received from Terminal.app by typing `$ echo $PATH` which is the export path variable in your .bash_profile. Copy the output and paste in  **_.env_**  file directly. 
  - **mysql_PATH**
   this is for _'env: mysql: No such file or directory'_ error, which occurs i.e. with WP Config command.
   - **rooturl**
    Where you run this app (Usually localhost)
    - **DB parameters**
    Database parameters: DB_HOST, DB_USER and DB_PASS.
    - **WP admin user info**
    Your admin credentials: admin_user, admin_mail, admin_password, display_name and description (Bio).


## main idea
	code is fun...



> Written with [StackEdit](https://stackedit.io/).