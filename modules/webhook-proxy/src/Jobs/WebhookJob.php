<?php
namespace Chatbox\WebhookProxy\Jobs;

use Chatbox\WebhookProxy\Model\WebhookLog;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class WebhookJob extends Job
{

	protected $log;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(WebhookLog $log)
    {
    	$this->log = $log;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
    	$url = $this->log->webhook->url;

    	$client = new Client();
    	try{
	        $response = $client->request("POST",$url,[
	        	"form_params" => $this->log->request_body
	        ]);
	        $this->log->updateByResponse($response);
	    }catch (RequestException $e){
			$this->log->updateByResponse($e->getResponse());
	    }
    }
}
