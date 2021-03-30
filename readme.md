#Nette web skeleton
keywords:
   - Nette 3.1
   - Nittro js
   - Nextras ORM
   - e2221/nette-grid, e2221/bootstrap-components, e2221/utils
   - contributte/forms-bootstrap

###Instalation
1) Create configuration file /app/config/local.neon with structure:
```
parameters:

    #database configuration
    database:
        host: database
        database: databasename
        username: user
        password: password

    #ftp configuration
    ftp:
        host: vsftpd
        username: admin
        password: ***
        homeDirectory: home
```

2) Configure XDEBUG (optional but do it before build containers)
   
   Create config file in .docker/xdebug/xdebug.ini with content:
```
zend_extension=xdebug.so
xdebug.mode=debug

;UBUNTU (replace with current IP address)
xdebug.client_host=192.168.0.105

;WINDOWS
;xdebug.client_host=host.docker.internal

xdebug.start_with_request=yes
```

2) Build docker containers
   
   There is prepared Makefile, so you can use only this command
```make upb```
   
   Without Makefile:
   ```docker-compose up -d --build```

3) Permissions to folders (not nested if you used ```make upb```)
```
sudo chmod -R 777 log/
sudo chmod -R 777 temp/
```

4) Switch off debug mode (optional) in app/Bootstrap.php
