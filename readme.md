# Conference Management System for Gobind Sarvar Schools

## Setting up local environment

You need a local PHP and MySQL environment to run the Laravel application that supports PHP version >= 5.5.9, OpenSSL, PDO, Mbstring and Tokenizer PHP Extension. The easiest way to get this up is to use MAMP, which bundles all the necessary stack application on your local machine.

#### Create a database from MAMP's phpMyAdmin

Once you've started up the MAMP server (hitting Start Server from MAMP), it will automatically launch a welcome page in your browser. From the `MySQL` section, note your `host`, `port`, `User` and `Password`, you will need this information to connect your Laravel app to the database.

Click on the phpMyAdmin link on the line "MySQL can be administered with phpMyAdmin." This will take you to the phpMyAdmin app bundled in MAMP that allows you to manipulate the MySQL database in a GUI. Select the `Databases` tab, create a new database with the collation `utf8_general_ci` (this seems to be the most frequently used charset). I named by database `cms`, but you can name it whatever you want.

#### Configure the Laravel app to connect to the MySQL database

From the root folder of your cloned repository, you should have a `.env.example` file. Any files or directories with the prefix `.` means its hidden from the File System, you will have to access it from the shell. Make a copy of this file and rename it to `.env`: You can use the unix command:

```shell
$  cp .env.example .env
```

Now to edit `.env` from the shell using nano (a small UNIX text editor), do the following from your root folder:

```shell
$  nano .env
```
Alternatively, you can open the folder from a text editor like Sublime Text or Atom and it should show up in the file tree. Replace the following 4 lines with the information you noted down from the MAMP welcome page. `127.0.0.1` is an alias for `localhost` and the number after `:` is the port number. `DB_DATABASE` should use the name that you used when creating your database. By default, the username and password for the MAMP MySQL database is `root` and `root`.

```
DB_HOST=127.0.0.1:8889
DB_DATABASE=cms
DB_USERNAME=root
DB_PASSWORD=root
```

Now you're all set with the database!

#### Auto-generate the database tables

From the root of the repository, do

```shell
$  php artisan migrate
```

This will automatically set up the necessary tables in the MySQL database. You can see these newly created tables from the phpMySQL web interface.

#### Start up the app!

Make sure MAMP installation is using the correct PHP version and pointing to the CMS directory. From the setting/preferences (depends on OS) of MAMP, you can change the PHP version in the `PHP` tab. Right now I'm using 5.6.10, we might want to decide which one we should use consistently, because there might be subtle differences between versions.

Configure the directory from which the web server will serve the pages by going to the `Web Server` tab and change the document root.

In the shell, do

```shell
$  php artisan up
```

This will prepare all the files necessary to serve up the application. Point your browser to `http://localhost:8888/public` or the public path relative to the document root you specified in the last step and you should see a big Laravel 5 in the centre of the page with a white background.




## Automatic deployment (Continuous Integration)

[Deploybot](http://deploybot.com) is a great tool to automatically deploy an application to an FTP server (in our project, it would be the GoDaddy hosting) on every push to the `master` branch.

## Languages used:
```
Laravel(Framework)
PHP
Javascript
JQuery
HTML
CSS
```