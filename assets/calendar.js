const editEventModal = new bootstrap.Modal(document.getElementById('edit-event-modal'));

const editEventTitle = document.getElementById('edit-event-title');
const editEventStart = document.getElementById('edit-event-start');
const editEventEnd = document.getElementById('edit-event-end');
const editEventAllDay = document.getElementById('edit-event-all-day');
const editEventDescription = document.getElementById('edit-event-description');
const editEventLocation = document.getElementById('edit-event-location');
const editEventBackgroundColor = document.getElementById('edit-event-background-color');
const editEventID = document.getElementById('edit-event-id');

const buttonEditEventConfirm = document.getElementById('edit-event-confirm');
const buttonDeleteEvent = document.getElementById('delete-event');

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
                    addEventModal.show();
                }
            },
        },
        headerToolbar: {
            start: 'prev,next today',
            center: 'title',
            end: 'addEventButton dayGridMonth,timeGridWeek,timeGridDay,listWeek',
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
        editable: true, // allow to drag events
        selectable: true,
        eventResizableFromStart: true, // allow to drag events
        height: 700,

        //GET EVENTS FROM API
        eventSources: [
            {url: window.location.protocol + '//' + window.location.host + '/api/events', method: 'GET'}
        ],

        // ~~~ ADD EVENT FROM CLICKING THE CALENDAR ~~~

        select: function(){
            addEventModal.show();
            //need to add the logic to create event with selected date
        },

        // ~~~ EDIT EVENT ~~~

        eventClick: function(event) {
            editEventModal.show();
            editEventTitle.value = event.event.title;
            editEventStart.value = event.event.start;
            editEventEnd.value = event.event.end;
            editEventAllDay.value = event.event.allDay;
            editEventDescription.value = event.event.extendedProps.description;
            editEventLocation.value = event.event.extendedProps.location;
            editEventBackgroundColor.value = event.event.backgroundColor;
            editEventID.value = event.event.id;

            buttonDeleteEvent.setAttribute('data-id', event.event.id);
            buttonEditEventConfirm.setAttribute('data-id', event.event.id);
        }

    });

    calendar.render(); 

    // Create an instance of Notyf to get access to toast messages in calendar
    const notyf = new Notyf({
        duration:5000,
        position: {
            x: 'right',
            y: 'bottom'
        },
        dismissible: true,
        ripple: false
    });

    // ~~~ ADD EVENT FROM "ADD BUTTON" ~~~

    const addEventModal = new bootstrap.Modal(document.getElementById('add-event-modal'));

    // Get the add event form
    document.getElementById('add-event-form').addEventListener("submit", function(e){
        // prevent submiting and page reload
        e.preventDefault();
        // fetch datas
        fetch(this.action, { // this refers to form
            method: 'POST',
            body: new FormData(e.target)
        })
        // handle 201 response
            .then(response => response.json())
            .then(calendar.refetchEvents()) //refetch all the events on the page
            .then(this.reset()) // reset the form
            .then(addEventModal.hide()) // hide the modal
            .then(notyf.success('Votre événement a été créé avec succès')) // toast success message
        // add json errors
    });

    // ~~~ EDIT EVENT ON DRAG AND DROP ~~~

    calendar.on('eventChange', function(e) {
        // fetch datas
        fetch(window.location.protocol + '//' + window.location.host + '/api/events/' + e.event.id, {
            method: 'PUT',
            headers: {
                'Content-Type':'application/json'
            },
            body:JSON.stringify(e.event)
        })
            .then(response => response.json())
            .then(calendar.refetchEvents())
            .then(notyf.success('Votre événement a été modifié avec succès')) // toast success message
        // add json errors
    });

    // ~~~ EDIT EVENT ~~~

    // WARNING : not tested because of date conversions 
    
    document.getElementById('edit-event-form').addEventListener("submit", function(e){
        e.preventDefault();
        // fetch datas
        fetch(window.location.protocol + '//' + window.location.host + '/api/events/' + buttonEditEventConfirm.getAttribute('data-id'), {
            method: 'PUT',
            headers: {
                'Content-Type':'application/json'
            },
            body:JSON.stringify({
                id: editEventID.value,
                title: editEventTitle.value,
                start: editEventStart.value,
                end: editEventEnd.value,
                allDay: editEventAllDay.value,
                description: editEventDescription.value,
                location: editEventLocation.value,
                backgroundColor: editEventBackgroundColor.value,
            })

        })
            // handle 200 response
            .then(response => response.json())
            .then(response => console.log(response))
            .then(calendar.refetchEvents()) //refetch all the events on the page
            .then(this.reset()) // reset the form
            .then(editEventModal.hide()) // hide the modal
            .then(notyf.success('Votre événement a été modifié avec succès')) // toast success message
        // add json errors
    });

    // ~~~ DELETE EVENT ~~~

    buttonDeleteEvent.addEventListener("click", function(e){
        // fetch datas
        fetch(window.location.protocol + '//' + window.location.host + '/api/events/' + buttonDeleteEvent.getAttribute('data-id'), { 
            method: 'DELETE',
            headers: {
                'Content-Type':'application/json'
            },
            body:JSON.stringify({
                id: buttonDeleteEvent.getAttribute('data-id')
            })
        })
        // handle 201 response
            .then(response => response.json())
            .then(calendar.refetchEvents()) //refetch all the events on the page
            .then(editEventModal.hide()) // hide the modal
            .then(notyf.success('Votre événement a été supprimé avec succès')) // toast success message
        // add json errors
    });

});

