# Apache2 Web Application with MySQL and RabbitMQ

A minimal Apache2 web application that displays connection status to MySQL and RabbitMQ servers.

## Requirements

- Docker
- MySQL server
- RabbitMQ server

## Environment Variables

The application requires the following environment variables:

### MySQL Configuration
- `MYSQL_HOST`: MySQL server hostname
- `MYSQL_PORT`: MySQL server port (default: 3306)
- `MYSQL_USER`: MySQL username
- `MYSQL_PASS`: MySQL password
- `MYSQL_DB`: MySQL database name

### RabbitMQ Configuration
- `RABBITMQ_HOST`: RabbitMQ server hostname
- `RABBITMQ_PORT`: RabbitMQ server port (default: 5672)
- `RABBITMQ_USER`: RabbitMQ username
- `RABBITMQ_PASS`: RabbitMQ password

## Building and Running

1. Build the Docker image:
```bash
docker build -t apache-app .
```

2. Run the container with environment variables:
```bash
docker run -d \
  -p 8080:80 \
  -e MYSQL_HOST=your_mysql_host \
  -e MYSQL_PORT=3306 \
  -e MYSQL_USER=your_mysql_user \
  -e MYSQL_PASS=your_mysql_password \
  -e MYSQL_DB=your_database \
  -e RABBITMQ_HOST=your_rabbitmq_host \
  -e RABBITMQ_PORT=5672 \
  -e RABBITMQ_USER=your_rabbitmq_user \
  -e RABBITMQ_PASS=your_rabbitmq_password \
  apache-app
```

3. Access the application at `http://localhost:8080`

## Features

- Displays connection status to both MySQL and RabbitMQ servers
- Responsive web interface
- Error handling for connection failures
- Environment variable configuration 