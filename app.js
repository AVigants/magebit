const emailField = document.getElementById('email');
const tosField = document.getElementById('tos_btn');
const form = document.getElementById('form');
const errors = document.getElementById('errors');
const regex = /^([a-z\d\.-]+)@([a-z\d-]+)\.([a-z]{2,8})(\.[a-z]{2,8})?$/;
let email = emailField.value;
let tos = tosField.checked;

//option 1: use local storage and then if smth exists then display the thankyou message
//option 2: if the url contains email then display the thanks message

const validate = () =>{
    if(email){
        if(regex.test(email)){
            if(email.slice(email.length-3, email.length) !== '.co'){
                if(tosField.checked){
                    errors.textContent = '';
                } else{
                    errors.textContent ='You must accept the terms and conditions'
                }
            } else{
                errors.textContent ='We are not accepting subscriptions from Colombia emails'
            }
        } else{
            errors.textContent ='Please provide a valid e-mail address'
        }
    } else{
        errors.textContent ='Email address is required';
    }
}

emailField.addEventListener('keyup', e=>{
    email = emailField.value;
    validate();
})

tosField.addEventListener('click', e=>{
    tos = tosField.checked;
    validate();
})

form.addEventListener('submit', e=>{
    if(errors.textContent || !email || !tos){
        e.preventDefault();
    } else{
        e.preventDefault();
        form.style.display = 'none';
        document.getElementById('heading').textContent = 'Thanks for subscribing!'
        document.getElementById('subheading').textContent = 'You have successfully subscribed to our email listing. Check your email for the discount code.'
    }
})