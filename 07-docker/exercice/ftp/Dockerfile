FROM debian:stable-slim

# Ajoute les dépôts et met à jour
RUN echo "deb http://deb.debian.org/debian stable main" > /etc/apt/sources.list && \
    apt-get update && \
    apt-get install -y pure-ftpd

# Crée le dossier FTP
RUN mkdir -p /home/ftpusers

COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 21 30000-30009
ENTRYPOINT ["/entrypoint.sh"]
