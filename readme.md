## Install

1 Install - [Fuseki RDF Store](https://jena.apache.org/download/#apache-jena-fuseki).
1.1 Create a new dataset named foodista and import Foodista triples from corresponding N-Quads file into dataset. 

2 Install a local Web Server - [Xampp](https://www.apachefriends.org/download.html), You need to make sure that Apache is running flawlessly. The project has been also tested successfully with other web servers like Nginx. 

3 Download or Clone the project from Github.

4 Extract it into root folder(if you're using Xampp, move it to the/path/to/your/xampp/folder/htdocs).

5 Rename the extracted folder to 'wtc'. Now the directory should seems like this: for example, if you installed Xampp in drive C:, then you should have your project in C:\xampp\htdocs\wtc

6 Edit the "hosts" file to enable mapping hostname to its IP address. 
6.1 in Windows, you may find it here: C:\Windows\System32\drivers\etc and in Linux its usually located in: 
6.2 Most likely you're using IP version 4 address so add this line: 127.0.0.1	wtc.dev

7 Install - [composer](https://getcomposer.org/download/). Consult this site and make sure composer has been installed correctly. 

8 Open command prompt, go to wtc folder,e.g: cd c:\xampp\htdocs\wtc

9 Run the command "Composer update". It will find, download and add all needed packages. Please be patient. It may take some minutes.

10 Now you are able to run the project in your favorite browser. Tyoe "wtc.dev" in addressbar and it should show you the landing page. 


## Possible issues:

1. Xampp has not been started or is not visible in system tray.

2. Xampp is started but Apache could not start through Xampp's control panel. It usually happens when the default port (80, 8080, ...) are blocked by other applications

3. Fuseki is not running, the default address and port of Fuseki should be like localhost:3030 and it's enough. If for any reason you have changed the defualt port please update controller file located in wtc/app/Http/Controllers/semanticController.php.



## Technical information

- Language:
  Backend: PHP
  FrontEnd: HTML5, CSS3, JQuery, [MaterializeCSS](http://materializecss.com/)
- Framework: [Laravel 5.3](https://laravel.com/) 
- Architecture: MVC
- Web Server: Apache  , Nginx 
- Local RDF Store: [Fuseki 2.4.1] (https://jena.apache.org/download/#apache-jena-fuseki)


## License

The project is open-sourced licensed under the [MIT license](http://opensource.org/licenses/MIT).
