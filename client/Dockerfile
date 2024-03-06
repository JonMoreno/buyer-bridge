# Dockerfile

# Use node alpine as it's a small node image
FROM node:alpine

RUN apk add --no-cache nano

# Create the directory on the node image 
RUN mkdir -p /app

# Set /app as the working directory
WORKDIR /app

# Copy package.json and package-lock.json
# to the /app working directory
COPY package.json ./
COPY package-lock.json ./

# Install dependencies in /app
RUN npm install --force

# Copy the rest of our Next.js folder into /app
COPY . /app   

# Ensure port 3000 is accessible to our system
EXPOSE 3000

# Run yarn dev, as we would via the command line 
CMD ["npm", "run", "dev"]