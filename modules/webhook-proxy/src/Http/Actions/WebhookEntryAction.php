<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2018/02/23
 * Time: 20:01
 */

namespace Chatbox\WebhookProxy\Http\Actions;


use Chatbox\WebhookProxy\Jobs\WebhookJob;
use Chatbox\WebhookProxy\Model\Webhook;
use Chatbox\WebhookProxy\Http\Exceptions\ValidationException;
use Chatbox\WebhookProxy\Model\WebhookLog;

class WebhookEntryAction {

	use ActionsTrait;

	public function handle($name){

		$webhook = Webhook::findByName($name);

		if(!$webhook instanceof Webhook){
			return abort(404);
		}
		$webhooklog = (new WebhookLog())->createByRequest($webhook,$this->request());

		if($webhook->url){
			dispatch(new WebhookJob($webhooklog));
		}

		return $this->response([
			"challenge" => $this->request()->get("challenge")
		]);


	}

	protected function payload(){
		return [
			"name" => $this->request()->get("name"),
			"url" => $this->request()->get("url"),
		];
	}

	protected function rules(){
		return [
			"name" => ["required"],
			"url" => ["url"],
		];
	}
}