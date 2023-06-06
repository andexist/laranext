export PROJECT_NAME=web
export IMAGE_NAME=web
export PROJECT_TITLE="Time Tracking App"
export PROJECT_HTTP_PORT=3000

.SILENT:info

info:
	echo ""
	echo "\033[92m${PROJECT_TITLE}\033[0m"
	echo ""
	echo "	- \033[35mHTTP:\033[0m : http://localhost:${PROJECT_HTTP_PORT}"
	echo ""

upd:
	docker-compose -p=${PROJECT_NAME} up -d
	make info

down:
	docker-compose -p=${PROJECT_NAME} down

build:
	docker-compose -p=${PROJECT_NAME} build --no-cache

bash:
	docker exec -it ${IMAGE_NAME} /bin/sh

logs:
	docker-compose -p=${PROJECT_NAME} logs -t --follow --tail=500