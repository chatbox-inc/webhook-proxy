<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2018/02/23
 * Time: 20:01
 */

namespace Chatbox\WebhookProxy\Http\Actions;


use Chatbox\WebhookProxy\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\Factory;
use Illuminate\Validation\Validator;

trait ActionsTrait {

	protected function request():Request{
		return app(Request::class);
	}

	protected function validate(array $data,array $rules,array $message=[]):Validator{
		return $this->validator()->make($data,$rules,$message);
	}

	protected function validator():Factory{
		return app("validator");
	}

	protected function response(array $data=[]){
		$response = app(Response::class);
		assert($response instanceof Response);
		return $response->ok($data);
	}
}