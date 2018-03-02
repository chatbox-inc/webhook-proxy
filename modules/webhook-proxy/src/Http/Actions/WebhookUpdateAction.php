<?php

namespace Chatbox\WebhookProxy\Http\Actions;

use Illuminate\Http\Request;
use DB;

class WebhookUpdateAction {

    public function handle(Request $request) {
//        return $request->name;

        DB::table('m_webhook')->where('name', $request->currentName)->update([
            'name' => $request->name,
            'url' => $request->url
        ]);
    }
}