# Webhook Proxy 

demo: http://cb-webhook-proxy-demo.herokuapp.com/

Webhook のリクエストとレスポンスをロギングするためのやつ

- Webhook の payload ログが見れる
- ngrok とかで URL が定期的に変更になる時、アプリ側に変えに行く手間が多少楽
− 複数URL を刺して、一つの client idで複数人の環境で開発できるように(予定)
 

## Usage

setup 

````
$ make setup
````

serve

````
$ npm run dev
````

### 構成

フロントは nuxt.js , バックエンドは Lumen で稼働しています。

