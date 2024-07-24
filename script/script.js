var formulario = document.querySelector('.contact-form');

formulario.addEventListener('submit', function(e){
    e.preventDefault();
    grecaptcha.ready(function() {
        grecaptcha.execute('6Lew6BYqAAAAAIzxhXitoNH4uqSgFMhdUQ2qA5_B', {action: 'submit'}).then(function(token) {

            var token_input = document.createElement('input');
            token_input.type = 'hidden';
            token_input.value = token;
            token_input.name = 'g-recaptcha-response';
            token_input.id = 'g-recaptcha-response';

            formulario.appendChild(token_input);
            
            const btn = formulario.getElementsByTagName('button');
            btn.disabled = true;
            
            // console.log(btn.disabled);

            formulario.submit();
        });
      });
})


