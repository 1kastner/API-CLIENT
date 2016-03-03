'use strict';
var request   =     require('request');
var APIURL    =     "http://api.burningsoul.in/";
module.exports = {

	moon:function(unixtimestamp,callback){
		if(unixtimestamp == null){unixtimestamp="";}
		request(APIURL+'/moon/'+unixtimestamp, function (error, response, body) {
  			if (!error && response.statusCode == 200) {
   				callback(body);
    		}
  		})
	}
}