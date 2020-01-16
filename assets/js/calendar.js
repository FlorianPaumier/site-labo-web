import {Calendar} from '@fullcalendar/core';
import bootstrapPlugin from '@fullcalendar/bootstrap';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import frLocale from '@fullcalendar/core/locales/fr';


document.addEventListener('DOMContentLoaded', function() {
    let calendarEl = document.getElementById('calendar');

    let events = [];

    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();

    /*  className colors

    className: default(transparent), important(red), chill(pink), success(green), info(blue)

    */


    /* initialize the external events
    -----------------------------------------------------------------*/
    $('#external-events div.external-event').each(function() {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
            title: $.trim($(this).text()) // use the element's text as the event title
        };

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject);

        // make the event draggable using jQuery UI
        $(this).draggable({
            zIndex: 999,
            revert: true,      // will cause the event to go back to its
            revertDuration: 0  //  original position after the drag
        });

    });

    fetch(route).then(response => {
        return response.json();
    }).then(response => {
        response.forEach(event => {
            events.push({
                title: event.name,
                start: event.happens_at,
                end: event.happens_at,
                description: event.description,
                extendedProps: {
                    place: event.place
                },
            })
        });

        /* initialize the calendar
-----------------------------------------------------------------*/
        let calendar = new Calendar(calendarEl , {
            header: {
                left: 'prev,next',
                center: 'title',
                right: 'dayGridDay,dayGridWeek,dayGridMonth'
            },
            editable: true,
            firstDay: 1, //  1(Monday) this can be changed to 0(Sunday) for the USA system
            selectable: true,
            plugins: [dayGridPlugin, listPlugin, timeGridPlugin, bootstrapPlugin],
            themeSystem : 'bootstrap',
            axisFormat: 'h:mm',
            defaultView: 'dayGridMonth',
            allDaySlot: true,
            locale: frLocale,
            selectHelper: true,
            select: function(start, end, allDay) {
                var title = prompt('Event Title:');
                if (title) {
                    calendar.fullCalendar('renderEvent',
                        {
                            title: title,
                            start: start,
                            end: end,
                            allDay: allDay,
                        },
                        true // make the event "stick"
                    );
                }
                calendar.fullCalendar('unselect');
            },
            eventClick: function(info) {
                let tooltipDiv = $("#calendar-modal");
                $(tooltipDiv).find(".modal-body").html(info.event.extendedProps.description);
                $(tooltipDiv).find(".modal-title").html(info.event.title);
                $(tooltipDiv).find(".modal-footer--content").html(info.event.extendedProps.place);
                tooltipDiv.modal("toggle");
            },
            droppable: false, // this allows things to be dropped onto the calendar !!!
            events : events
        });

        calendar.render();
    }).catch(error => {
        console.error(error);
    });

});