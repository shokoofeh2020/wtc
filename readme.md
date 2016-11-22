<p align="center"><a href="https://laravel.com" target="_blank"><img width="150"src="https://laravel.com/laravel.png"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

How to run this project without installing laravel. (Windows)

1 Install - [Fuseki](https://jena.apache.org/download/#apache-jena-fuseki) to use as RDF store.

2 Install - [Xampp](https://www.apachefriends.org/download.html), Actually it installs mysql server as well, but just need Apache as local server.

3 download the project from git and extract it to localhost folder with name 'wtc'. For example, if you installed Xampp in drive C:, then you should have your project in C:\xampp\htdocs\wtc

4 Add a new localhost to system hosts: Open file called 'hosts' form C:\Windows\System32\drivers\etc and add this line at the end of the file: 127.0.0.1	wtc.dev

5 Install - [composer](https://getcomposer.org/download/). Open command prompt, go to wtc folder, run the command "Composer update". It will compile all files and it may take several minutes.

6 Now one can run the project in the browser. One Just need to write wtc.dev in address bar and it will start. If it doesn't work, please make sure that Xampp is running, its icon is active in the system tray, and Apache is started in Xampp's control. In addition, make sure Fuseki is running, the address of Fuseki should be localhost:3030. Otherwise, the address of Fuseki should be updated in wtc/app/Http/Controllers/semanticcontroller.php.







## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb combination of simplicity, elegance, and innovation give you tools you need to build any application with which you are tasked.

## Learning Laravel

Laravel has the most extensive and thorough documentation and video tutorial library of any modern web application framework. The [Laravel documentation](https://laravel.com/docs) is thorough, complete, and makes it a breeze to get started learning the framework.

If you're not in the mood to read, [Laracasts](https://laracasts.com) contains over 900 video tutorials on a range of topics including Laravel, modern PHP, unit testing, JavaScript, and more. Boost the skill level of yourself and your entire team by digging into our comprehensive video library.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
