#IpBan

IpBan is a [StackPHP](http://www.stackphp.com) middleware for banning IP addresses to an application.

Just pass an array containing any banned IPs into the class constructor. Here is a sample usage with a Silex App and Stack\Builder:

```php
    require_once __DIR__.'/../vendor/autoload.php';

    $app = new \Silex\Application();

    $stack = (new Stack\Builder())
	    ->push('pno\IpBan', ['127.0.0.1']);

    $app = $stack->resolve($app);
```

By default, IpBan returns a Symfony 403 Response with the message "Your IP has been bannded." To change that, just pass in a different Response object:
 
 ```php
     $response = new Symfony\Component\HttpFoundation\Response('STAY OFF MY LAWN!!! >(', 403);
     $stack = (new Stack\Builder())
         ->push('pno\IpBan', ['127.0.0.1'], $response);
 ```
 
 Enjoy!
