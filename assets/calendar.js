

document.addEventListener('DOMContentLoaded', function() {
    let calendarEl = document.getElementById('calendar');
    let calendar = new FullCalendar.Calendar(calendarEl, {
        themeSystem: 'bootstrap5',
        initialView: 'timeGridWeek',
        locale: 'fr',
        timeZone: 'Europe/Paris',
        firstDay: 1, //start with Monday
        customButtons: { //custom add button
            addEventButton: {
                text: 'Ajouter',
                click: function(){
                    modal.show();
                }
            },
        },
        headerToolbar: {
            start: 'prev,next today',
            center: 'title',
            end: 'addEventButton dayGridMonth,timeGridWeek,timeGridDay,listDay',
            // end: 'dayGridMonth,timeGridWeek,timeGridDay,listDay',
        },
        buttonText: { //translate the headerToolbar content
            today: 'Aujourd\'hui',
            month: 'Mois',
            week: 'Semaine',
            day: 'Jour',
            list: 'Agenda'
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
        editable: true, //allow to drag events
        height: 700,

        //GET EVENTS FROM API
        eventSources: [
            {url: window.location.protocol + '//' + window.location.host + '/api/events', method: 'GET'}
        ],
    });

    calendar.render(); 

    // Create an instance of Notyf to get access to toast messages
    const notyf = new Notyf({
        duration:5000,
        position: {
            x: 'right',
            y: 'bottom'
        },
        dismissible: true,
        ripple: false
    });

    // ~~~ ADD EVENT ~~~

    // Get modal with the following id
    const modal = new bootstrap.Modal(document.getElementById('add-event-modal'));

    // Get the add event form
    document.getElementById('add-event-form').addEventListener("submit", function(e){
        // prevent submiting and page reload
        e.preventDefault();
        // fetch datas
        fetch(this.action, { // this refers to form
            body: new FormData(e.target),
            method: 'POST'
        })
        // handle 200 response
            .then(response => response.json())
            .then(calendar.refetchEvents())
            .then(this.reset()) // reset the form
            .then(modal.hide()) // hide the modal
            .then(notyf.success('Votre événement a été créé avec succès')) // toast success message
        // add errors
    });

});

