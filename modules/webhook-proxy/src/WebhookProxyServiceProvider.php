<?php
namespace Chatbox\WebhookProxy;
use Chatbox\WebhookProxy\Http\Actions\WebhookCreateAction;
use Chatbox\WebhookProxy\Http\Actions\WebhookEntryAction;
use Chatbox\WebhookProxy\Http\Actions\WebhookListAction;
use Chatbox\WebhookProxy\Http\Actions\WebhookLogsAction;
use Illuminate\Support\ServiceProvider;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2018/02/23
 * Time: 19:21
 */
class WebhookProxyServiceProvider extends ServiceProvider {

	public function boot(  ) {
		app()->router->group(["prefix"=>"/webhook/"],function ($route) {
			$route->post("{name}",WebhookEntryAction::class."@handle");
		});
		app()->router->group(["prefix"=>"/api/"],function ($route) {
			$route->post("webhook",WebhookCreateAction::class."@handle");
			$route->post("webhook/list",WebhookListAction::class."@handle");
			$route->get("webhook/logs/{name}",WebhookLogsAction::class."@handle");
		});

	}

	public function register(  ) {

	}

}