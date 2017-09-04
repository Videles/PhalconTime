# PhalconTime Application

PhalconTime is a timekeeping tool that helps you track hours spend on clients and projects.

Please write me if you have any feedback.

## NOTE

The master branch will always contain the latest stable version. If you wish
to check older versions or newer ones currently under development, please
switch to the relevant branch.

## Get Started

### Requirements

* PHP >= 7.0.x (lower versions might work but are not tested)
* [Apache][2] Web Server with [mod_rewrite][3] enabled or [Nginx][4] Web Server
* Latest stable [Phalcon Framework release][5] extension enabled
* [MySQL][6] >= 5.7.x (lower versions might work but are not tested)

### Installation

First you need to clone this repository:

```
$ git clone git@github.com:Videles/PhalconTime.git
```

Or via HTTPS

```
$ git clone https://github.com/Videles/PhalconTime.git
```

Create the database via either the Phalcon Developer Tools - Migrations or via the database phalcon-time.sql dump file, see app/migrations/phalcon-time.sql

### Configuration

Open app/config/config.php and set the parameters for the database connection and basepath / domain URI

Create the directory public/img/uploads and /cache and set the right permissions for both directories i.e. 755

## Credentials

The default login credentials are:

Username: Admin
Password: ChangeThisPassword

## License

PhalconTime is lincensed under MIT. © Videles. See LICENSE.md for more information.
