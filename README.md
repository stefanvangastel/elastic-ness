# elastic-ness

Logregel demo met verschillende datastructuren in 1 Elasticsearch index

## Elastic + Kibana starten

Gebruik de `docker-compose.yml` om de pre-filled Elastic met gekoppelde Kibana te starten op de locale poorten:

```
docker-compose up -d
```

Open Kibana op [http://localhost:5601](http://localhost:5601)

## Extra data genereren

Start eerst de EK stack zoals hierboven beschreven. Gebruik daarna het [`generator.php`](generator/generator.php) script om random data naar Elastic te posten:

```
php generator/generator.php
```
