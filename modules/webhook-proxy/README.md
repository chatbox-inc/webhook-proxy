# Webhook Proxy 

Webhook のリクエストとレスポンスをロギングするための仕組み

- [ ] 画面の作成
- [ ] 登録画面からDBに登録
- [ ] 一覧画面の作成
- [ ] WebHookエントリをロギング出来るように
- [ ] ログの一覧を表示
 
## API 


### POST /api/webhook

Webhook エントリポイントの作成を行います。

payload:
  slug: (optional)
  url: (optional) コールバック先URL(非同期)  
response:
  status: OK
  webhook:
    slug: {your token}
    url: コールバック先URL

### GET /webhook/{token}

Webhook エントリポイントとして機能します。

### GET /logs/{token}

Webhook エントリポイントとして機能します。

parameters:
    from: 取得日時(含まない)
response: 
    $i.status: requested -> processed
    $i.requested_at: Y-m-d H:i:s
    $i.payload: リクエストパラメータ
    $i.result: レスポンス
    
    

