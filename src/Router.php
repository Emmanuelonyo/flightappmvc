<?php
declare(strict_types=1);

namespace App;

class Router
{
    private array $handler;
    private  $notFoundHandler;
    private const METHOD_POST = "POST";
    private const METHOD_GET = "GET";
    private const METHOD_PUT = "PUT";
    private const METHOD_DELETE = "DELETE";
    private const METHOD_UPDATE = "UPDATE";
    private const METHOD_PATCH = "PATCH";
    

    public function get(string $path, $handler): void
    {
        $this->makeHandler(self::METHOD_GET, $path, $handler);
    }

    public function post(string $path, $handler): void{
        $this->makeHandler(self::METHOD_POST, $path, $handler);
    }

    public function delete(){

    }

    public function update(){

    }

    public function patch(){

    }

    public function put(){

    }

    private function makeHandler(string $method, string $path, $handler): void
    {
        $this->handler[$method . $path] = [
            'path' => $path,
            'method' => $method,
            'handler' => $handler
        ];
    }

    public function makeNotfoundHandler($handler): void
    {
        $this->notFoundHandler = $handler;
    }


    public function run(){
        $requestUri = parse_url($_SERVER['REQUEST_URI']);
        $requestPath = $requestUri['path'];
        $method = $_SERVER['REQUEST_METHOD'];
        $callback = NULL;


        foreach ($this->handler as $handler){
            if ($handler['path'] === $requestPath && $method === $handler['method']){
                $callback = $handler['handler'];
            }
        }

        if(is_string($callback)){
            $parts = explode('::', $callback);

            if(is_array($parts)){
                $className = array_shift($parts);
                $handler = new $className;

                $method = array_shift($parts);
                $callback = [$handler , $method];
            }
        }

        if(!$callback){
            header("HTTP/1.0 404 Not Found");
            if(!empty($this->notFoundHandler)){
                $callback = $this->notFoundHandler;
            }
        }


        call_user_func_array($callback, [
            array_merge($_GET, $_POST)
        ]);
    }

}