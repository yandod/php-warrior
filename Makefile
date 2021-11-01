setup:
	docker-compose run --rm composer install --ignore-platform-reqs --prefer-dist --no-suggest

test-setup:
	docker-compose run --rm php-cli mkdir -m 777 -p ./phpwarrior/test-beginner/
	docker-compose run --rm php-cli curl -L http://git.io/vLvDR > phpwarrior/test-beginner/player.php
	docker-compose run --rm php-cli echo 'O:18:"PHPWarrior\Profile":14:{s:5:"score";d:0;s:4:"epic";b:1;s:10:"epic_score";i:0;s:18:"current_epic_score";d:523;s:13:"average_grade";N;s:19:"current_epic_grades";a:9:{i:1;d:1;i:2;d:0.88461538461538458;i:3;d:0.85915492957746475;i:4;d:0.8666666666666667;i:5;d:0.89430894308943087;i:6;d:0.62857142857142856;i:7;d:0.73999999999999999;i:8;d:1;i:9;d:0.92000000000000004;}s:9:"abilities";a:9:{i:0;s:4:"walk";i:1;s:4:"feel";i:2;s:6:"attack";i:3;s:6:"health";i:4;s:4:"rest";i:5;s:6:"rescue";i:6;s:5:"pivot";i:7;s:4:"look";i:8;s:5:"shoot";}s:12:"level_number";i:9;s:17:"last_level_number";N;s:10:"tower_path";s:17:"./towers/beginner";s:12:"warrior_name";s:4:"test";s:11:"player_path";s:26:"./phpwarrior/test-beginner";s:5:"tower";O:16:"PHPWarrior\Tower":1:{s:4:"path";s:17:"./towers/beginner";}s:5:"epice";b:0;}' > phpwarrior/test-beginner/.pwprofile

test:
	docker-compose run --rm php-cli ./bin/phpwarrior -d phpwarrior/test-beginner/ -t 0 -s

test-ja:
	docker-compose run -e LANG=ja_JP.UTF8 --rm php-cli ./bin/phpwarrior -d phpwarrior/test-beginner/ -t 0 -s

test-ru:
	docker-compose run -e LANG=ru_RO.UTF8 --rm php-cli ./bin/phpwarrior -d phpwarrior/test-beginner/ -t 0 -s

run:
	docker-compose run --rm php-cli php ./bin/phpwarrior

clean:
	docker-compose down