###Instalation
1) Create configuration file /app/config/local.neon with structure:
```
parameters:

    #database configuration
    database:
        host: database
        database: databasename
        username: cyklorysavy
        password: ***

    #ftp configuration
    ftp:
        host: vsftpd
        username: admin
        password: ***
        homeDirectory: home
```

2) Configure XDEBUG (optional only for production) - do before docker-compose
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
   ```docker-compose up -d --build```

3) Permissions to folders:
```
sudo chmod -R 777 log/
sudo chmod -R 777 temp/
```

4) Switch off debug mode (optional only for production)
