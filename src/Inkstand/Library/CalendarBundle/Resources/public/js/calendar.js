
var Calendar = (function(selector) {

    var $calendarElement = $(selector);
    var calendarId = $calendarElement.data('calendar-id');
    var options = $calendarElement.data('options');

    options.eventDataTransform = function (event) {
        event.editable = true;
        return event;
    };

    options.header = {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
    };

    options.editable = true;
    options.droppable = true;

    options.eventDrop = function (event) {
        saveEvent(event);
    };

    options.drop = function(date, allDay) { // this function is called when something is dropped
        console.log("drop");
        var originalEventObject = $(this).data('eventObject');

        if (originalEventObject.external) {
            console.log("HERE");
            // we need to copy it, so that multiple events don't have a reference to the same object
            var copiedEventObject = $.extend({}, originalEventObject);

            // assign it the date that was reported
            copiedEventObject.start = date;
            copiedEventObject.allDay = true;

            // render the event on the calendar
            // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
            $calendarElement.fullCalendar('renderEvent', copiedEventObject, true);

            saveEvent(copiedEventObject);
        }
    };

    $calendarElement.fullCalendar(options);

    var saveEvent = function(event) {
        var newEvent = {};

        if (newEvent.id == undefined) {
            newEvent.id = null;
        }

        newEvent.calendarId = calendarId;

        newEvent.title = event.title;
        newEvent.start = event.start;
        newEvent.allDay = event.allDay;

        console.log(newEvent);

        $.ajax({
            url: "/inkstand/web/app_dev.php/calendar/event/save",
            method: "post",
            data: {event: JSON.stringify(newEvent) }
        });
    }
});