FROM nginx

RUN apt update
RUN apt install wget -y
RUN wget https://artifacts.elastic.co/downloads/beats/filebeat/filebeat-7.5.1-amd64.deb
RUN dpkg -i filebeat-7.5.1-amd64.deb
#COPY filebeat.yml /etc/filebeat/filebeat.yml
#ENTRYPOINT service filebeat start
#ENTRYPOINT service filebeat start && /bin/bash