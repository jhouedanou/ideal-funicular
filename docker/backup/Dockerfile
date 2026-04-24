FROM mariadb:11

# Scripts de sauvegarde / restauration.
COPY backup.sh     /usr/local/bin/backup.sh
COPY restore.sh    /usr/local/bin/restore.sh
COPY entrypoint.sh /usr/local/bin/entrypoint.sh

RUN chmod +x /usr/local/bin/backup.sh \
             /usr/local/bin/restore.sh \
             /usr/local/bin/entrypoint.sh

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["schedule"]
