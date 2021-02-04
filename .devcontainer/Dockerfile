# See here for image contents: https://github.com/microsoft/vscode-dev-containers/tree/v0.155.1/containers/php/.devcontainer/base.Dockerfile

# [Choice] PHP version: 7, 7.4, 7.3
ARG VARIANT="7"
FROM php:${VARIANT}-apache
# FROM mcr.microsoft.com/vscode/devcontainers/php:0-${VARIANT}

#Since we are not using vscode's container, add user:
ARG USERNAME=vscode
ARG USER_UID=1000
ARG USER_GID=$USER_UID

RUN groupadd --gid $USER_GID $USERNAME \
    && useradd --uid $USER_UID --gid $USER_GID -m $USERNAME
    #
    # [Optional] Add sudo support. Omit if you don't need to install software after connecting.
    # && apt-get update \
    # && apt-get install -y sudo \
    # && echo $USERNAME ALL=(\root\) NOPASSWD:ALL > /etc/sudoers.d/$USERNAME \
    # && chmod 0440 /etc/sudoers.d/$USERNAME

# [Option] Install Node.js
# ARG INSTALL_NODE="true"
# ARG NODE_VERSION="lts/*"
# RUN if [ "${INSTALL_NODE}" = "true" ]; then su vscode -c "umask 0002 && . /usr/local/share/nvm/nvm.sh && nvm install ${NODE_VERSION} 2>&1"; fi

# [Optional] Uncomment this section to install additional OS packages.
# RUN apt-get update && export DEBIAN_FRONTEND=noninteractive \
#     && apt-get -y install --no-install-recommends <your-package-list-here>

# [Optional] Uncomment this line to install global node packages.
# RUN su vscode -c "source /usr/local/share/nvm/nvm.sh && npm install -g <your-package-here>" 2>&1

ARG UPGRADE_PACKAGES="true"

# Install needed packages and setup non-root user. Use a separate RUN statement to add your own dependencies.
RUN apt-get update \
    && apt-get -y install --no-install-recommends lynx \
    && sed -i -e "s/Listen 80/Listen 80\\nListen 8080/g" /etc/apache2/ports.conf \
    && apt-get clean -y 

# Install git
RUN apt-get -y install git

# Install xdebug
RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && rm -rf /tmp/pear

# Add DS (PHP)
# RUN yes | pecl install ds

# Install composer (note that this adds a lot of overhead right now due to composer cache)
# If using a bound volume it might be worth it.
# RUN curl -sSL https://getcomposer.org/installer | php \
#     && chmod +x composer.phar \
#     && mv composer.phar /usr/local/bin/composer

#PHPUnit
#--dev
# RUN composer require phpunit/phpunit

#Install excercism?