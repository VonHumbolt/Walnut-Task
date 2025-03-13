FROM node:18-alpine

WORKDIR /usr/src/app

COPY package*.json ./

RUN npm install

RUN apt-get update && apt-get install -y gnupg wget && \
  wget --quiet --output-document=- https://dl-ssl.google.com/linux/linux_signing_key.pub | gpg --dearmor > /etc/apt/trusted.gpg.d/google-archive.gpg && \
  echo "deb [arch=amd64] http://dl.google.com/linux/chrome/deb/ stable main" > /etc/apt/sources.list.d/google-chrome.list && \
  apt-get update && \
  apt-get install -y google-chrome-stable --no-install-recommends && \
  rm -rf /var/lib/apt/lists/*

COPY . .

EXPOSE 3000

CMD ["node", "src/server.js"]