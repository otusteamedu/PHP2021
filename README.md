# PHP2021 HW-11 (ElasticSearch + YouTube)

<h3>Консольные команды для тестирования:</h3>

- Добавление информации о канале: php index.php store <id канала>
- Статистика по каналу: php index.php statistic <id канала> [топ N каналов]
- Автоматическое наполнение каналов (паук):  php index.php spider <id каналов через запятую>

<h3>Структура индексов:</h3>

<h5>Индекс канала</h3>

```json
{
  "channel": {
    "mappings": {
      "properties": {
        "title": {
          "type": "text",
          "fields": {
            "keyword": {
              "type": "keyword",
              "ignore_above": 256
            }
          }
        }
      }
    }
  }
}
```

<h5>Индекс видео</h3>

```json
{
  "video": {
    "mappings": {
      "properties": {
        "channel_id": {
          "type": "text",
          "fields": {
            "keyword": {
              "type": "keyword",
              "ignore_above": 256
            }
          }
        },
        "dislike_count": {
          "type": "long"
        },
        "like_count": {
          "type": "long"
        },
        "title": {
          "type": "text",
          "fields": {
            "keyword": {
              "type": "keyword",
              "ignore_above": 256
            }
          }
        }
      }
    }
  }
}
```

<h3>Запросы на получение статистики:</h3>

<h5>Топ N каналов:</h3>
GET video/_search
```json
{
  "runtime_mappings": {
    "actual_likes": {
      "type": "long",
      "script": {
        "source": "emit(doc['like_count'].value - doc['dislike_count'].value)"
      }
    }
  },
  "aggs": {
    "top_channels": {
      "categorize_text": {
        "field": "channel_id"
      },
      "aggs": {
        "sum_likes": {
          "sum": {
            "field": "actual_likes"
          }
        },
        "likes_bucket_sort": {
          "bucket_sort": {
            "sort": [
              {
                "sum_likes": {
                  "order": "desc"
                }
              }
            ],
            "size": 2
          }
        }
      }
    }
  },
  "size": 0
}
```

<h5>Количество лайков и дизлайков</h5>
GET video/_search
```json
{
  "query": {
    "match": {
      "channel_id": "UCwXdFgeE9KYzlDdR7TG9cMw"
    }
  },
  "aggs": {
    "like_count": {
      "sum": {
        "field": "like_count"
      }
    },
    "dislike_count": {
      "sum": {
        "field": "dislike_count"
      }
    }
  },
  "size": 0
}
```