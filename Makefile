serve:
	php -S 0.0.0.0:8000 -t public
setup:
	cp .env.example .env
	composer install
	npm i
	npm run dev
	make serve