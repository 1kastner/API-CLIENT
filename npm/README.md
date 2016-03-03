# Burningsoul API Client npm Package
## How to Use

* Install the package

	`npm install burningsoul-api`
* Add to code

    `var api_client = require(burningsoul-api);` 
    
* Usage
 ```javascript
    var moon = api_client.moon(unixtimestamp,callback(result){
        /* do something with result*/
    });
 ```