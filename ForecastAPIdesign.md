# Forecast API design

Design to set/read the forecast for a specific city for a specific date

## Read Forecast

Get forecast for a city by date.
If date is not specified set to today  
Use format: YYYY-MM-DD or words "today" and "tomorrow"

    > GET /cities/{cityId}/forecast/{day}
    
Following the musement API schema return:

    "responses": {
           "200": {
               "description": "Returned when successful",
           },
           "400": {
               "description": "Returned when there is a bad request (ie: wrong day format, neither today nor tomorrow)"
           },
           "404": {
               "description": "Returned when resource (forecast and/or city) is not found"
           },
           "500": {
               "description": "Returned when a backend error occurred"
           },
           "503": {
               "description": "Returned when the service is unavailable"
           }
       }

API add the informations regarding weather to the city

    <id>57</id> <name><![CDATA[Amsterdam]]></name>  
    <code><![CDATA[amsterdam]]></code>  
    <forecast_date><![CDATA[2021-06-04]]></code>   
    <forecast><![CDATA[Partly cloudy]]></code>


## SET Forecast

Set the forecast for a city by date.
Use format: YYYY-MM-DD or words "today" and "tomorrow"

    > POST /cities/{cityId}/forecast/  

Parameters to pass:

    
    "day": {
        "description": "Day to add | YYYY-MM-DD",
        "type": "string",
        "format": "date"
    }
    "forecast": {
        "description": "Forecast for the city",
        "type": "string"
    },

As above API return the following status code:  

    "201": {
        "description": "Returned when successful"
    },
    "400": {
        "description": "Returned when there is a bad request (ie: wrong day format, neither today nor tomorrow)"
    },
    "403": {
        "description": "Returned when you don't have permissions"
    },
    "500": {
        "description": "Returned when a backend error occurred"
    },
    "503": {
        "description": "Returned when the service is unavailable"
    }