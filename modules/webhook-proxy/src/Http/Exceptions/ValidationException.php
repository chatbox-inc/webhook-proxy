<?php
namespace Chatbox\WebhookProxy\Http\Exceptions;
use Chatbox\WebhookProxy\Http\Response;
use Illuminate\Validation\Validator;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2018/02/23
 * Time: 20:14
 */
class ValidationException extends \Illuminate\Validation\ValidationException {

	public function __construct( \Illuminate\Contracts\Validation\Validator $validator) {
		$response = $this->createErrorResponse($validator);
		parent::__construct( $validator, $response );
	}

	protected function createErrorResponse( Validator $validator ) {
		$response = app(Response::class);
		assert($response instanceof Response);
		return $response->bad([
			"errors" => $validator->errors()
		]);
	}


}