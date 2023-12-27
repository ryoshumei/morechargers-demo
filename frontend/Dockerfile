# build: docker build -t vue-app .
FROM node:lts AS build-stage

# set working directory
WORKDIR /app

# copy package.json and package-lock.json to workdir
COPY package*.json ./

# install dependencies
RUN npm install

# copy all files to workdir
COPY . .

# build app for production
RUN npm run build

# production stage
FROM nginx:stable-alpine as production-stage

# use nginx.conf from local
COPY --from=build-stage /app/dist /usr/share/nginx/html

# expose port 80
EXPOSE 80

# run nginx
CMD ["nginx", "-g", "daemon off;"]

