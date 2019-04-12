function instala_sistema_efood(){
	$("a").hide();
	$(".avisos_instalacao").hide();
	$(".instalador_body").show();
}


$(document).ready(function(){
        'use strict';   

        $('#wizard4').steps({
          headerTag: 'h3',
          bodyTag: 'section',
          autoFocus: true,
          titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
          cssClass: 'wizard step-equal-width',
          onStepChanging: function (event, currentIndex, newIndex) {
            if(currentIndex < newIndex) {
               
               if(currentIndex === 0) {
                  var nome_local = $('#nome_local').parsley();
                  var cnpj_local = $('#cnpj_local').parsley();

                  if(nome_local.isValid() && cnpj_local.isValid() ) {
                    return true;
                  } else {
                    nome_local.validate();  
                    cnpj_local.validate();
                    
                  }
               }

              // Step 1 form validation
              if(currentIndex === 1) {
                var caminho = $('#caminho').parsley();
                var nome_banco = $('#nome_banco').parsley();
                var senha_banco = $('#senha_banco').parsley();
                var user_banco = $('#user_banco').parsley();

                if(nome_banco.isValid() && user_banco.isValid() && senha_banco.isValid()) {
                  return true;
                } else {
                  caminho.validate();  
                  nome_banco.validate();
                  user_banco.validate();
                  senha_banco.validate();
                }
              }

              // Step 2 form validation
              if(currentIndex === 2) {

                var nome_pessoa = $('#nome_pessoa').parsley();
                var user1 = $('#user1').parsley();
                var user2 = $('#user2').parsley();
                var senha1 = $('#senha1').parsley();
                var senha2 = $('#senha2').parsley();

                if(user1.isValid() && user2.isValid() && senha1.isValid() && senha2.isValid() && nome_pessoa.isValid()) {
                  return true;
                } else { 
                    nome_pessoa.validate(); 
                    user1.validate(); 
                    user2.validate(); 
                    senha1.validate(); 
                    senha2.validate(); 
                }
              }


              
            // Always allow step back to the previous step even if the current step is not valid.
            } else { return true; }
          }
        });

        
      });