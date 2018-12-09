# Quick Start
## Get Content
```php
$http = new HttpGetAgent('http://www.example.com?a=1');
$http->addGetParameter('b', 2);
$http->addGetParameter('c', 3);
$result = $http->request();
//this will get content from http://www.example.com?a=1&b=2&c=3
```

## Post Content like a form
```php
$http = new HttpPostFormAgent('http://www.example.com/contact');
$http->setRequestHeader('Referer', 'http://www.example.com');
$http->addPostParameter('name', 'foo');
$http->addPostParameter('tel', 'bar');
$http->addPostParameter('email', 'dummy@example.com');
$http->addPostParameter('message', 'Lorem ipsum dolor sit amet, ...');
$result = $http->request();
```

## Post JSON content
```php
$http = new HttpPostJsonAgent('http://www.example.com/submit_json);
$http->postData=array('a'=>1, 'b'=>2);
$result = $http->request();
```
