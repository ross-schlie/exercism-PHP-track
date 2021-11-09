FROM php:8-cli-alpine

#Since we are not using vscode's container, add user:
# https://wiki.alpinelinux.org/wiki/Setting_up_a_new_user
ARG USERNAME=vscode
RUN apk add bash
RUN adduser --disabled-password -s /bin/bash $USERNAME

ARG APP_DIR=/app
WORKDIR $APP_DIR

# RUN chown -R $USERNAME $APP_DIR && chmod -R 775 $APP_DIR
USER vscode

CMD [ "tail", "-f", "/dev/null" ]