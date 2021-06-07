### Alessandro Badiglio

# Jaggad - Backend PHP tech homework
## Step 1 | Development

To keep a consistent coding standard (PSR12) I used PHP_CodeSniffer
in a combination with Visual Studio Code plugin.

This extension is designed to use auto configuration search mechanism to apply rulesets to files. 

### How it works

The application retrieve a list of cities from Musement API 
and for each of them try to get the forecast for today and tomorrow date
using the WeatherAPI. 

The resuls it printed using a basic HTML page (index.php) in the form:
> "Processed city [city name] | [weather today] - [wheather tomorrow]"

#### PHPUnit

All tests are included inside the *tests* folder.

Further when the docker image is created will be created an alias to PHPUnit in order to call the function directly.

To run the tests have access to a shell in the docker i.e.:

> docker exec -it jagaadtest_webapp_1 /bin/bash

and execute 

> phpunit tests/ 


## Step 2 | API design 

I have created a file (in the root) called **ForecastAPIdesign.md** where I explain how the new API should works
and a description about its behavior.

## Installation with Docker

Install and deploy in a Docker container.

>By default, the Docker will expose port 8000, so change this within the
Dockerfile if necessary.  

```sh
git clone https://github.com/axelbad/jagaadTest.git .
cd jagaadTest
docker-compose up -d
```

Verify the deployment by navigating to your server address in
your preferred browser.

```sh
127.0.0.1:8000
```
## License
[MIT](https://choosealicense.com/licenses/mit/)

**Free Software, Hell Yeah!**
