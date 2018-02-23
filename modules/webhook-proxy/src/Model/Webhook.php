<?php
namespace Chatbox\WebhookProxy\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2018/02/23
 * Time: 20:09
 */
class Webhook extends Model {

	static public function findByName( $name ):?Webhook {
		return static::where("name",$name)->first();
	}

	protected $table = "m_webhook";

	protected $guarded = [];

	public function logs(  ) {
		return $this->hasMany(WebhookLog::class,"webhook_id");
	}


}