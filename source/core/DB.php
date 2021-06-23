<?php 
    use Elasticsearch\ClientBuilder;
    class DB{
        protected $client;
        protected $exist;
        public function __construct(){
            require_once "./vendor/autoload.php";
                $hosts = [
                    [   
                        'host' => 'localhost',
                        'port' => '9200',
                        'scheme' => 'http'
                    ]
                ];

            $this->client = ClientBuilder::create()->setHosts($hosts)->build();

            $this->exist = $this->client->indices()->exists(['index'=>'data']);
        }
    }
?>