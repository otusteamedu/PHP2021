FROM ubuntu:latest

# Install.
RUN \
  apt-get update && \
  apt-get -y upgrade && \
  apt-get install -y bc && \
  rm -rf /var/lib/apt/lists/*

COPY root/calc.sh /home/calc.sh
COPY root/table /home/table
COPY root/popular-cities.sh /home/popular-cities.sh
