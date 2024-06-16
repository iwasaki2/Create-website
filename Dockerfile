# Use an official Nginx runtime as a base image
FROM nginx:alpine

# Copy the contents of the local 'public' directory to the Nginx document root
COPY public/ /usr/share/nginx/html

# Expose port 80 to allow external access
EXPOSE 80

# Start Nginx server on container startup
CMD ["nginx", "-g", "daemon off;"]
