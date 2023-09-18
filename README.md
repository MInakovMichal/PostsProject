## Installation

1. Clone git repository:
    - git clone https://github.com/MInakovMichal/PostsProject.git
2. Go to project directory and run script responsible for .env and .env.testing files initialization:
    - ./init.sh
3. Build and run containers:
    - docker-compose up -d --build
4. Wait 60 seconds until everything will be ready
5. Run npm container:
    - npm run dev

## Environments

### Local

- http://localhost - api
- http://localhost:8081 - phpmyadmin
- http://localhost:8083 - mailcatcher
