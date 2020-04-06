# base image
FROM nginx:1.16.0-alpine

# Labels
LABEL ch.ejpd.maintainer="Mark CAMERON mark.oliver.cameron@gmail.com>" \
    ch.ejpd.os="Alpine" \
    ch.ejpd.sourceurl="https://github/markcameron/employees-list" \
    ch.ejpd.manufacturer="DevFactory"

# copy artifact build from the 'build environment'
COPY ./dist/angular9-springboot-client /usr/share/nginx/html

# copy the overwrite the nginx default config file with our own custom one
COPY ./default.conf /etc/nginx/conf.d/default.conf

# expose port 80
EXPOSE 80

# run nginx
CMD ["nginx", "-g", "daemon off;"]
