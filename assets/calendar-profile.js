document.addEventListener('DOMContentLoaded', function() {
    let calendarEl = document.getElementById('calendar');
    let calendar = new FullCalendar.Calendar(calendarEl, {
        themeSystem: 'bootstrap5',
        initialView: 'listWeek',
        locale: 'fr',
        timeZone: 'Europe/Paris',
        firstDay: 1, //start with Monday
        customButtons: { //custom add button
            addEventButton: {
                text: 'Ajouter',
                click: function(){
                    addEventModal.show();
                }
            },
        },
        headerToolbar: {
            start: 'prev,next today',
            center: 'title',
            end: 'listDay,listWeek',
            // end: 'dayGridMonth,timeGridWeek,timeGridDay,listDay',
        },
        buttonText: { //translate the headerToolbar content
            today: 'Aujourd\'hui',
            listDay: 'Journée',
            listWeek: 'Semaine'
        },
        eventTimeFormat: { 
            hour: 'numeric', 
            minute: '2-digit', 
            meridiem: false 
        },
        firstHour: 8,
        businessHours: {
            daysOfWeek: [1,2,3,4,5],
            startTime: '08.00.00',
            endTime: '18.00.00',
        },
        height: 400,

        //GET EVENTS FROM API
        eventSources: [
            {url: window.location.protocol + '//' + window.location.host + '/api/events', method: 'GET'}
        ],

    });

    calendar.render(); 

});