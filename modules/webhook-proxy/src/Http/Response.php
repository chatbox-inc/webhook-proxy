<?php
namespace Chatbox\WebhookProxy\Http;
use Illuminate\Http\JsonResponse;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2018/02/23
 * Time: 20:15
 */
class Response {

	protected function response($data,$status,$header=[]){
		return \Illuminate\Http\Response::create($data,$status,$header);
	}

	public function ok(array $data){
		$data["status"] = "OK";
		return $this->response($data,200);
	}
	public function bad(array $data,$status=400){
		$data["status"] = "BAD";
		return $this->response($data,$status);
	}
	public function error(array $data,$status=500){
		$data["status"] = "ERROR";
		return $this->response($data,$status);
	}

}