## Description

Laravel action-based microservice API application using Laravel, optimized for
workload efficiency, leveraging Laravel Octane. 

## Installation
Install dependencies
```bash
composer install
```

Start docker containers and serve the app at localhost
```bash
./vendor/bin/sail up -d
```
Run migrations
```bash
./vendor/bin/sail artisan migrate:fresh --seed
```
## Consume Queue

```bash
./vendor/bin/sail artisan queue:work
```

## Tests

```bash
./vendor/bin/sail artisan migrate:fresh --seed --env=testing
```

```bash
./vendor/bin/sail artisan test
```

## Stress Test

```bash
./vendor/bin/pest stress http://localhost/api/jobs --post='{\"title\": \"Nuno\", \"tasks\": [\"summary\"]}'
```
I get this results after launching the command

| Metric                      | Value               |
|-----------------------------|---------------------|
| Test Duration               | 5.03 s              |
| Test Concurrency            | 1                   |
| Requests Count              | 53.66 reqs/s 270    |
| Success Rate                | 100.0 %             |
| DNS Lookup Duration         | 0.51 ms             |
| TLS Handshake Duration      | 0.00 ms             |
| Request Duration            | 17.67 ms            |
| Upload 0.0 %                | 0.00 MB/req 0.01 MB/s 0.00 ms |
| TTFB 93.2 %                 | 16.46 ms            |
| Download 5.6 %              | 0.00 MB/req 0.91 MB/s 1.00 ms |

