<?php
namespace Chatbox\WebhookProxy\Model;

use GuzzleHttp\Psr7\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2018/02/23
 * Time: 20:09
 */
class WebhookLog extends Model {

	protected $table = "t_webhook_log";

	protected $guarded = [];

	protected $casts = [
	    'request_body' => 'array',
	    'request_headers' => 'array',
	    'response_body' => 'array',
	    'response_headers' => 'array',
    ];

	public function webhook(  ) {
		return $this->belongsTo(Webhook::class,"webhook_id");
	}

	public function createByRequest(Webhook $webhook,Request $request ) {
		$this->fill([
			"request_body" => $request->all(),
			"request_headers" => $request->header(),
			"remote_host" => $request->server("REMOTE_HOST",$request->server("REMOTE_ADDR")),
		]);
		$this->webhook()->associate($webhook);
		$this->save();
		return $this;
	}

	public function updateByResponse(Response $response){
		$this->fill([
			"response_status" => $response->getStatusCode(),
			"response_body" => $response->getBody()->getContents(),
			"response_headers" => $response->getHeaders(),
		]);
		$this->save();
	}

}