<?php

namespace Chatbox\WebhookProxy\Http\Actions;

use DB;

class WebhookDeleteAction {

    public function handle($name) {
      DB::table('m_webhook')->where('name', $name)->delete();
    }
}