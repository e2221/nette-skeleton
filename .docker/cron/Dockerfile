FROM php:8.0.2-apache

RUN a2enmod rewrite
RUN docker-php-ext-install pdo pdo_mysql mysqli && docker-php-ext-enable mysqli

##########################INSTALL CRON
RUN apt-get update && apt-get install cron -y -qq
##########################END

##########################CREATE FOLDER FOR CRON SHELLS
RUN mkdir /cronShells
##########################END


##########################CREATE CUSTOM CRON SHELLS
# ProductionCover/ImportsProcess.php - only for demonstration (Production Cover is included in Universal Cron)
#RUN echo 'php /var/www/html/cron/ProductionCover/ImportsProcess.php' > /cronShells/ImportsProcess.sh
#RUN echo 'echo Cron - `date +"%H:%M:%S"` - ProductionCover/ImportsProcess /var/www/html/cron/ProductionCover/ImportsProcess.php' >> /cronShells/ImportsProcess.sh
#universal cron
RUN echo 'php /var/www/html/cron/Cron.php' > /cronShells/Cron.sh
RUN echo 'echo Cron - `date +"%H:%M:%S"` - UniversalCron /var/www/html/cron/Cron.php' >> /cronShells/Cron.sh
##########################END


##########################CREATE CUSTOM CRON SHELLS
RUN chmod -R +x /cronShells
##########################END


##########################REGISTER CRON JOBS
# register cron jobs to start the applications and redirects their stdout/stderr
# to the stdout/stderr of the entry process by adding lines to /etc/crontab
# to see all crontab look
#RUN echo "*/1 * * * * root /cronShells/ImportsProcess.sh > /proc/1/fd/1 2>/proc/1/fd/2" >> /etc/crontab
RUN echo "*/1 * * * * root /cronShells/Cron.sh > /proc/1/fd/1 2>/proc/1/fd/2" >> /etc/crontab
##########################END

##########################START CRON
# start cron in foreground (don't fork)
ENTRYPOINT [ "cron", "-f" ]
##########################END