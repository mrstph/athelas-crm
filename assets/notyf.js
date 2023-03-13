// import { Notyf } from 'notyf';
// import 'notyf/notyf.min.css'; // for React, Vue and Svelte

// Create an instance of Notyf
const notyf = new Notyf({
    duration:5000,
    position: {
        x: 'right',
        y: 'bottom'
    },
    dismissible: true,
    ripple: false
});

let messages = document.querySelectorAll('div');
console.log(messages)

messages.forEach(message => {
    if(message.className == 'notify success-message'){
        notyf.success(message.innerHTML);
    }

    if(message.className == 'notify error-message'){
        notyf.error(message.innerHTML);
    }
});