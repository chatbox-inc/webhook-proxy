<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2018/02/23
 * Time: 20:01
 */

namespace Chatbox\WebhookProxy\Http\Actions;


use Chatbox\WebhookProxy\Model\Webhook;
use Chatbox\WebhookProxy\Http\Exceptions\ValidationException;

class WebhookListAction {

	use ActionsTrait;

	public function handle(){

		$webhooks = Webhook::all();
		return $this->response([
			"webhook_list" => $webhooks
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