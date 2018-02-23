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

class WebhookCreateAction {

	use ActionsTrait;

	public function handle(){

		$validator = $this->validate($this->payload(),$this->rules());
		if(!$validator->passes()){
			throw new ValidationException($validator);
		}
		$webhook = Webhook::create($this->payload());
		return $this->response([
			"webhook" => $webhook
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