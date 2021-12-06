# Vet-schedule

### Overview
Our veterinarians are asking for a system that allows them to manage their schedule by giving them the ability to **enter time periods when they are not available** (such as when an appointment is booked, or if they have to run an errand). Since we are a global company, this solution will need to incorporate time zones. 

### Data
Data is a .json file in vet-schedule/app/data

### Classes 
Controller: vet-schedule/app/Http/Controllers/CheckAvailableTimeController

Model: vet-schedule/app/Models
- Appointments
- Appointment
- AppointmentHandler
- CheckDateTimeResponse
 
### Requirements
- Docker 

### How to run
- docker-compose up -d

### Inside container
- docker exec -it vet-schedule sh

### Run tests
- docker run --rm -it --volume %cd%:/app php bash -c "cd app/; php vendor/bin/phpunit"

```
PHPUnit 9.5.10 by Sebastian Bergmann and contributors.

Example
 ✔ Example

Check Available Time
 ✔ It should return available true for no booked date time with different_timezone_offset_before_appointments
 ✔ It should return available true for no booked date time with different_timezone_offset_after_appointments
 ✔ It should return available true for no booked date time with available
 ✔ It should return available true for no booked date time with available_between_blocks
 ✔ It should return available false for booked date time with block_different_timezone_offset
 ✔ It should return available false for booked date time with block_exists
 ✔ It should return available false for invalid date time with empty_date
 ✔ It should return available false for invalid date time with invalid_date
 ✔ It should return available false for invalid date time with string_instead_date

Appointment
 ✔ It should return scheduling conflict when appointment was taken
 ✔ It should return scheduling conflict when appointment was taken from half time before
 ✔ It should not return scheduling conflict when appointment was not taken

Time: 00:00.501, Memory: 10.00 MB

OK (13 tests, 18 assertions)
``` 
### Service
- Check if time is available

#### Available time
Request:
```
POST http://localhost:8000/checkTime
```
Payload:
```
{
    "datetime_start": "2020-11-29T11:00:00-05:00"
}
``` 
Response:
```
{"status":"success","message":"The datetime_start is available.","available":true}
``` 
#### Not available time
Request:
```
POST http://localhost:8000/checkTime
```
Payload:
```
{
    "datetime_start": "2020-11-30T11:00:00-06:00"
}
``` 
Response:
```
{"status":"success","message":"The datetime_start is not available.","available":false}
``` 

#### Invalid date
Request:
```
POST http://localhost:8000/checkTime
```
Payload:
```
{
    "datetime_start": "2222-99-85T08:00:00-ABC123"
}
``` 
Response:
```
{"status":"error","message":"The datetime_start is not valid.","available":false}
``` 
#### GET
It is possible to call using GET also

Request:
```
GET http://localhost:8000/checkTime/2020-11-29T11:00:00-05:00 
```
Response:
```
{"status":"success","message":"The datetime_start is available.","available":true}
```

## More info
 - vet-schedule/info