# Basic Checkin System

A simple web-based checkin system created for leagues and cups.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

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

A live demo is available under the following domain

```
https://checkin.yourcustomcode.com
```
## Authors

* [Tim Ganther](https://github.com/Tim-Ganther) - Backend and Frontend
* [Thorsten Schmitt](https://github.com/sthorsten) - Initial CSS Framework

## Contributing

Please read [CONTRIBUTING.md](https://gist.github.com/PurpleBooth/b24679402957c63ec426) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/your/project/tags). 

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
