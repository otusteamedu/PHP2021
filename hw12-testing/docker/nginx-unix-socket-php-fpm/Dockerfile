FROM nginx

ARG UID
ARG USERNAME

COPY nginx.conf /etc/nginx/nginx.conf
COPY default.conf /etc/nginx/conf.d/default.conf

RUN addgroup --gid $UID --system $USERNAME \
  && adduser --uid $UID --system --disabled-login --disabled-password --gid $UID $USERNAME \
  && sed -i -r "s/%REPLACE_USERNAME%/$USERNAME/g" /etc/nginx/nginx.conf

CMD ["nginx", "-g", "daemon off;"]