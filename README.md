# A Full Stack CMS with an API, Authentication and CRUD components

These are the files for a custom built Laravel 8 Application with Vue 2 integration.

## Changelog

## v1
* Initial build with Database migrations and seeds. Added Vue Components for Neighbourhood creating, display and editing along with components for individual house creation and editing with foreign key constraining Neighbourhood to House.

Added API endpoints for both Neighbourhood and House CRUD functionality (not entirely complete for House component yet) along with blade template files and usage of Vue Router to toggle Vue components on a single page.

Added FormRequest for form validation and Policy for authentication. Scaffolded Autentication system for user register and login, along with email verification and forgotten password reset.

## Usage

To install the application, clone the files and update .env with your DB and SMTP settings, replacing the placeholder values with your server settings.

######

GETTING STARTED (for Mac/Linux machines)

* Make sure to have MySQL 5.7+, PHP 7.3+, Node 10+ and Composer 1+ installed on your machine. CD into the root directory and run **composer install** to install PHP dependencies. Run as well **npm install** for Node dependencies (for Webpack preprocessing, BrowserSync watching and Cache busting among other things).

* To install a VM for development (not necessary but reccomended for development purposes), for starters you'll need to install Virtualbox and Vagrant (Mac/Linux OS). Instructions are listed on their respective sites. Make sure to create if you already have not SSH keys to connect to the virtual machine. Once these are complete, run **vagrant box add laravel/homestead** to add the Vagrant box to Homestead.

To configure Homestead, run **git clone https://github.com/laravel/homestead.git ~/Homestead** then cd into the Homestead folder, and run **git checkout release** to make sure you have the latest version on your machine. You'll nedd to configure a yaml file and initialize Homestead, which on Mac/Linux you run **init.sh**. Create a directory in the Homestead folder with your project folder name and open up the yaml file and adjust yaml file settings to map your project edits from the homestead path to your local path in the sites settings. Update database name accordingly.

For Mac/Linux, update your hosts file (~/etc/hosts), add your yaml file IP address and your project url as well.

CD into the Homestead folder and run **vagrant up** (might take a couple of minutes). Once VM is running run **vagrant ssh** to get into the shell and should be good from there.

Refer to https://laravel.com/docs/8.x/homestead for more information on Laravel 8 Homestead installation.

* Once you have made your edits and are ready for deployment, be sure to run **npm run production** to create a production build of the site that you can deploy.

* For deployment purposes, depending on your hosting setup you can try https://forge.laravel.com/ for starters or whatever is more suitable to you.