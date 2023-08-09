# Dead Letter Queue Example with Symfony and PHP 8.2

This repository provides an example of how to implement a Dead Letter Queue (DLQ) pattern with Symfony and PHP 8.2. The DLQ pattern helps handle and store failed messages during message processing, allowing you to identify and analyze problematic messages.

## Requirements

To run this example, make sure you have the following installed on your system:

- Docker and Docker Compose (for running containers)
- PHP 8.2 (for running the Symfony application locally, if needed)

## Project Structure

The project has the following structure:

```
├── .env
├── .env.example
├── .gitignore
├── docker-compose.yml
├── Dockerfile
├── caddy
│   └── Caddyfile
├── symfony
│   ├── config
│   │   └── packages
│   │       └── enqueue.yaml
│   ├── public
│   │   └── index.php
│   └── src
│       ├── Controller
│       │   └── SomeController.php
│       ├── Entity
│       │   └── FailedMessage.php
│       ├── Messenger
│       │   └── MyMessageHandler.php
│       └── MyMessage.php
├── mysql_data
└── readme.md
```

## Getting Started

1. Clone the repository:

   ```bash
   git clone https://github.com/yourusername/dead-letter-queue.git
   cd dead-letter-queue
   ```

2. Create a `.env` file based on the provided `.env.example` and customize it with your desired settings:

   ```bash
   cp .env.example .env
   ```

3. Build and run the Docker containers using Docker Compose:

   ```bash
   docker-compose up -d
   ```

4. Install the PHP dependencies with Composer:

   ```bash
   docker-compose exec php composer install
   ```

5. Run the database migrations to create the necessary tables:

   ```bash
   docker-compose exec php bin/console doctrine:migrations:migrate
   ```

6. Access the Symfony application through Caddy server at `http://localhost`.

## Description

This example demonstrates how to implement the DLQ pattern using Symfony and RabbitMQ. When a message processing fails, the message is moved to a Dead Letter Queue, and an entry is stored in the database using Doctrine. The failed messages are then available for later analysis and debugging.

The Symfony application contains the following components:

- **MyMessage**: A custom message class representing the message data to be processed.

- **MyMessageHandler**: A Symfony message handler responsible for processing the messages. If a processing failure occurs, the message is moved to the Dead Letter Queue.

- **SomeController**: A simple controller with a `/test` route to trigger the message processing.

- **FailedMessage**: An entity representing the failed messages stored in the database.

- **enqueue.yaml**: The configuration file for the enqueue bundle, defining the RabbitMQ transport and related settings.

## Usage

1. Access the Symfony application at `http://localhost` and navigate to the `/test` route.

2. The `/test` route will dispatch a sample message (`MyMessage`) to be processed by the message handler (`MyMessageHandler`). If the processing fails, the message will be moved to the Dead Letter Queue, and a record will be stored in the database with the details of the failed message.

3. You can access RabbitMQ's management web interface at `http://localhost:15672` (guest/guest) to monitor the message queues and DLQ.

## Contributing

Feel free to contribute to this repository by submitting issues or pull requests. Your contributions are highly appreciated.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

---

This repository serves as an example for implementing the Dead Letter Queue pattern in Symfony and PHP 8.2. It demonstrates the usage of Docker, RabbitMQ, and Symfony to handle failed messages and store them in the database. Please refer to the specific files in the repository for detailed implementations and configurations.

Feel free to reach out if you have any questions or need further assistance. Happy coding!
