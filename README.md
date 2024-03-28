## Description

Laravel action-based microservice API application using Laravel, optimized for
workload efficiency, leveraging Laravel Octane. 

## Installation
Install dependencies
```bash
composer install
```

Configure a shell alias that allows you to execute Sail's commands more easily:
```bash
alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'
```




Start docker containers
```bash
sail up -d
```
Run migrations
```bash
sail artisan migrate --seed
```


## Running the app

Serving App
```bash
sail artisan octane:start
```

## Tests

```bash
sail artisan test
```

## Stress Test

```bash
sail ./vendor/bin/pest stress http://localhost/api/jobs --post='{\"title\": \"Nuno\", \"tasks\": [\"summary\"]}'
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

