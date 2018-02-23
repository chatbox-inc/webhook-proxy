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

class WebhookLogsAction {

	use ActionsTrait;

	public function handle($name){

		$webhooks = Webhook::findByName($name);

		if(!$webhooks instanceof Webhook){
			abort(404);
		}

		$data = [];

		$query = $webhooks->logs();
		$data["count"] = $query->count();

		$pageSize = 10;
		if($page = $this->request()->get("page")){
			$query = $query->offset($page*$pageSize);
		}
		$query = $query->limit($pageSize);
		$query = $query->orderBy("created_at","DESC");
		$data["logs"] = $query->get();

		return $this->response($data);


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