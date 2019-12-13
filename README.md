# Basic Checkin System

A simple web-based checkin system created for leagues and cups.

## Getting Started

These instructions will get you a copy of the project up and running on a live system.

### Prerequisite

What things you need to install the software

```
Webserver of your choice (e.g apache2)
php packages installed (prefered 7+)
SQL DB Server (e.g mariadb)
```

### Installing

A step by step series of how to implement the system

1. Clone the repo to your webroot

```
git clone https://github.com/Tim-Ganther/checkin-system
```

2. Setup a DB and import the following tables

```
checkin_teams.sql
checkins.sql
```
3. Modify /includes/db.php according to your db

```
mysql:host=localhost;dbname=yourDBname', 'dbUserName', 'dbpassword'
```

4. Just open your webroot/admin from a browser and add a first checkin

```
https://yourdomain.com/admin
```
5. Have fun using and altering the system!

## Live Demo

A live demo is available under the following urls. The Admin Login is default (User:Password)

```
https://checkin.yourcustomcode.com
https://checkin.yourcustomcode.com/admin
```
## Authors

* [Tim Ganther](https://github.com/Tim-Ganther) - Backend and Frontend
* [Thorsten Schmitt](https://github.com/sthorsten) - Initial CSS Framework

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
