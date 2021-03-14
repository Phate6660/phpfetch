# PHPFetch
An info fetch tool written in PHP. Because why not. /shrug

## Running
- Install PHP and composer
- Clone the repo:
  + `git clone https://github.com/Phate6660/phpfetch && cd phpfetch`
- Get browscap:
  + `composer require browscap/browscap-php`
  + `vendor/bin/browscap-php browscap:fetch`
  + `vendor/bin/browscap-php browscap:convert`
- Run the PHP server:
  + `php -c php.ini -S localhost:8000`
- Open the web page in your browser at `localhost:8000/phpfetch.php`

## Output
![screenshot](screenshot.png?raw=true)

## TODO
- Support BSD
- Support more package counts:
  + dnf
  + dpkg
  + ~~portage (pure PHP)~~
  + rpm
  + xbps
  + zypper
