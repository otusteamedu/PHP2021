<h2>Структура хранения информации о канале и видео канала в ElasticSearch</h2>

```json
{
  "youtubechannel" : {
    "properties" : {
        "name" : {"type" : "string"},
        "url" : {"type" : "string"},
        "videos" : {
            "properties" : {
                "title" : {"type" : "string"},
                "videourl" : {"type" : "string"},
                "like" : {"type" : "integer"},
                "dislikes" : {"type" : "integer"}
            }
        }
    }
}
}
```

Mappings
```json
{
  "mappings": {
    "youtubechannels_index": {
      "properties": {
        "created_at": {
          "type": "date"
        },
        "id": {
          "type": "long"
        },
        "name": {
          "type": "text",
          "fields": {
            "keyword": {
              "type": "keyword",
              "ignore_above": 256
            }
          }
        },
        "updated_at": {
          "type": "date"
        },
        "url": {
          "type": "text",
          "fields": {
            "keyword": {
              "type": "keyword",
              "ignore_above": 256
            }
          }
        },
        "videos": {
          "properties": {
            "dislikes": {
              "type": "long"
            },
            "like": {
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
            },
            "videourl": {
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
  }
}
```
