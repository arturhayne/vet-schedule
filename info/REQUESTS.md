Request Payload (Available)
```json
{
    "datetime_start": "2021-11-29T11:00:00-05:00"
}
```
Expected Response
```json
{
    "status":"success",
    "message":"The datetime_start is available.",
    "available":true
}
```
---
Request Payload (Available)
```json
{
    "datetime_start": "2021-11-30T16:00:00-05:00"
}
```
Expected Response
```json
{
    "status":"success",
    "message":"The datetime_start is available.",
    "available":true
}
```
---
Request Payload (Block exists)
```json
{
    "datetime_start": "2021-11-30T10:00:00-05:00"
}
```
Expected Response
```json
{
    "status":"success",
    "message":"The datetime_start is not available.",
    "available":false
}
```
---
Request Payload (Available, different timezone offset)
```json
{
    "datetime_start": "2021-11-30T10:00:00-06:00"
}
```
Expected Response
```json
{
    "status":"success",
    "message":"The datetime_start is available.",
    "available":true
}
```
---
Request Payload (Block exists, different timezone offset)
```json
{
    "datetime_start": "2021-11-30T11:00:00-06:00"
}
```
Expected Response
```json
{
    "status":"success",
    "message":"The datetime_start is not available.",
    "available":false
}
```
---
Request Payload (Invalid datetime_start)
```json
{
    "datetime_start": "2222-99-85T08:00:00-ABC123"
}
```
Expected Response
```json
{
    "status":"error",
    "message":"The datetime_start is not valid.",
    "available":false
}
```
---
Request Payload (Missing datetime_start)
```json
{
    "datetime_start": ""
}
```
Expected Response
```json
{
    "status":"error",
    "message":"The datetime_start is not valid.",
    "available":false
}
```
---
