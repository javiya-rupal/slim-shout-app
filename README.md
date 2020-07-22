# slim-shout-app
Basic API integration of gettings quotes shouted by Famous persons.

## Installation
* Clone git repository in your server
* In Console, go to your project directory, install composer and run command "composer install".
* Now Run the API in your browser with URL http://localhost/[ your-app-name ]/shout/[ persona name ]/[ number of quote ]
* With command line, run command curl -s http://localhost/[ your-app-name ]/shout/[ persona name ]/[ number of quote ]
* For negetive test, one may run URl with passing 0 or any string value in "number of quote" argument.
* If request with same parameters executed again, then data will be serve from cache with 304 not modified http status code.

## Write me if you have any queries
* Write to rupal.javiya@gmail.com

## Screenshots
![Run API from browser](https://github.com/javiya-rupal/slim-shout-app/blob/master/public/docs/browser-request.png)
![Run API from browser with invalid argument](https://github.com/javiya-rupal/slim-shout-app/blob/master/public/docs/request-with-invalid-argument.png)
![Run API from browser with requesting 0 quote](https://github.com/javiya-rupal/slim-shout-app/blob/master/public/docs/request-with-0.png)
![Run API from commandline](https://github.com/javiya-rupal/slim-shout-app/blob/master/public/docs/command-line-request.png)
![Unit test sample](https://github.com/javiya-rupal/slim-shout-app/blob/master/public/docs/unit-testing.png)
![Request cache](https://github.com/javiya-rupal/slim-shout-app/blob/master/public/docs/request-cache)