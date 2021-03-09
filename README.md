# PHPFetch
An info fetch tool written in PHP. Because why not. /shrug

## Running
- Install PHP and (optionally) <a href="https://github.com/Phate6660/pkg">Phate6660/pkg</a> for the portage package count.
- Clone the repo:
  + `git clone https://github.com/Phate6660/phpfetch && cd phpfetch`
- Run the PHP server:
  + `php -S localhost:8000`
- Open the web page in your browser at `localhost:8000/phpfetch.php`

## Output
![screenshot](screenshot.png?raw=true)

## TODO
- Make `filesize()` work with `/proc` files
- Support BSD
- Support more package counts:
  + dnf
  + dpkg
  + portage (pure PHP)
  + rpm
  + xbps
  + zypper
