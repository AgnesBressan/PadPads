
/* Feito por: Agnes Bressan de Almeida, Augusto Amaral Domingues, Isabela de Castro Navarro, Sofia Azevedo Rosa, Stephanie Camargo Antonelli e Yasmin Oliveira de Sousa. */

/* Scripts em Java Script utilizados durante todo o projeto de ecommerce.*/

////////////////////////////////////////////////////////////////////////   Cadastro de usuários

function mudarEstado(el) {
    document.getElementById(el).style.display='block';
}

function tamanhoSenha(senha){
    document.getElementById('avisofinal').innerHTML = "";
    if(senha==null) document.getElementById('aviso').innerHTML="";
    if(senha.length>0 && senha.length<8){
        return false;
    }
    else if(senha.length>16){
        document.getElementById("senhaForca").style.border="1px solid red";

        document.getElementById('aviso').innerHTML="A senha deve ser menor que 16 caracteres!<br>";
        return false;
    }
    else document.getElementById('aviso').innerHTML="";
    document.getElementById('senhaForca').style.border="0";
    document.getElementById('senhaForca').style.borderBottom ="2px solid lightgrey";
    document.getElementById('confirmasenha').style.border="0";
    document.getElementById('confirmasenha').style.borderBottom ="2px solid lightgrey";
    return true;
}


function confirmarSenha(){
    document.getElementById('avisofinal').innerHTML = "";
    var confirma=document.getElementById('confirmasenha').value,
        senha = document.getElementById('senhaForca').value;
    if(confirma!=senha){
        document.getElementById('aviso2').innerHTML ="As senhas não correspondem!";
        return false;
    }
    else document.getElementById('aviso2').innerHTML ="";
    return true;
}

/*
    As funções seguintes - mostrarForca(forca), validarForca - foram desenvolvidas pela equipe 
    Celke, adaptadas para o projeto de ecommerce. 
    O programa, juntamente com um vídeo de seu desenvolvimento, está disponível em: https://celke.com.br/artigo/como-validar-a-forca-da-senha-com-javascript
*/
function mostrarForca(forca) {
    document.getElementById('fraca').style.backgroundColor="lightgray";
    document.getElementById('media').style.backgroundColor="lightgray";
    document.getElementById('forte').style.backgroundColor="lightgray";
    document.getElementById('otima').style.backgroundColor="lightgray";
    if(forca<0){
        document.getElementById('mostrarForca').innerHTML = "<span style='color: #ff0000; '> Erro!</span>";
    }
    if (forca>-1 && forca < 30) { //se não tiver nenhuma letra
        document.getElementById('mostrarForca').innerHTML = "<span style='color: #ff0000; '> Fraca</span>";
        document.getElementById('fraca').style.backgroundColor="red";
    } else if ((forca >= 30) && (forca < 50)) { //se tiver letra minuscula
        document.getElementById('mostrarForca').innerHTML = "<span style='color: #FFD700; '> Média</span>";
        document.getElementById('fraca').style.backgroundColor="#FFD700";
        document.getElementById('media').style.backgroundColor="#FFD700";
    } else if ((forca >= 50) && (forca < 80)) { //se tiver letra maiuscula
        document.getElementById('mostrarForca').innerHTML = "<span style='color: #7FFF00; '> Forte</span>";
        document.getElementById('fraca').style.backgroundColor="#7FFF00";
        document.getElementById('media').style.backgroundColor="#7FFF00";
        document.getElementById('forte').style.backgroundColor="#7FFF00";
    } else if ((forca >= 80) && (forca < 100)) { //se tiver caractere especial
        document.getElementById('fraca').style.backgroundColor="#008000";
        document.getElementById('media').style.backgroundColor="#008000";
        document.getElementById('forte').style.backgroundColor="#008000";
        document.getElementById('otima').style.backgroundColor="#008000";
        document.getElementById('mostrarForca').innerHTML = "<span style='color: #008000; '> Ótima</span>";       
    }
    //return forca;
}

function validarForca() {
    var senha = document.getElementById('senhaForca').value,
        forca = 0; //ele zera a força todas as vezes que analisa

        if ((senha.length >= 4) && (senha.length <= 7)) {
            forca += 10;
        } 
        else if (senha.length >= 8) { //pode ter quantos caracteres for, se forem apenas numeros, a senha é FRACA
            forca += 30;
        }
        //força por letra
        if ((senha.length >= 7) && (senha.match(/[a-z]+/))) {
            forca += 10;
        }
    
        if ((senha.length >= 8) && (senha.match(/[A-Z]+/))) {
            forca += 20;
        }
    
        if ((senha.length >= 8) && (senha.match(/[@#$%&;*]/))) {
            forca += 25;
        }
        
        if(senha.length>16) forca=-1;

    tamanhoSenha(senha);

    if(senha.length==0) {
        document.getElementById('mostrarForca').innerHTML = "Força";
        
        document.getElementById('fraca').style.backgroundColor="lightgray";
        document.getElementById('media').style.backgroundColor="lightgray";
        document.getElementById('forte').style.backgroundColor="lightgray";
        document.getElementById('otima').style.backgroundColor="lightgray";
    }
    else mostrarForca(forca);
    
    if(document.getElementById('confirmasenha').value.length>0) confirmarSenha();
    return forca;
}
/* ---------------------------fim das funções retiradas de celke.com.br--------------------------------- */

function env(){
    var senha = document.getElementById('senhaForca').value,
        forca=validarForca(),
        erro="none",
        s=true;
    if(confirmarSenha()==false || tamanhoSenha(senha)==false || forca<30){
        if(forca<30 || tamanhoSenha(senha)==false) {
            document.getElementById("senhaForca").style.border="1px solid red";
            document.getElementById('aviso').innerHTML="Senha muito curta!"
            erro="senha";
        }
        if(confirmarSenha()==false){
            document.getElementById("confirmasenha").style.border="1px solid red"; 
            erro+="confirma";
        }

        if(erro.match(senha))document.getElementById("senhaForca").focus();
        else if(erro=="confirma")document.getElementById("confirmasenha").focus();
        s=false;
    }
    return s;
}

function envAdm(){
    var senha = document.getElementById('senhaadm').value;
    if(senha.length<8){
        document.getElementById('avisofinal2').innerHTML = "Senha muito curta!";
        return false;
    }
    return true; 
}

////////////////////////////////////////////////////////////////////////   Carrinho

function esvazia(){
    document.getElementById('aviso').innerHTML= "";
    document.getElementById('aviso2').innerHTML= "";
    document.getElementById('avisofinal').innerHTML= "";
    document.getElementById('mostrarForca').innerHTML= "";
}

function mudaqtd(acao){
    var qtd= document.getElementById('qtd').value;
    if(acao=='up'){
        
    }
}
function changeSelect(){
    if(document.getElementById('catg').value=='outro'){
        display=document.getElementById('outro').style.display = 'block';
        document.getElementById('outro').getAttribute("required");
    }
    else display=document.getElementById('outro').style.display = 'none';
}

function mudaEstado(id){
    if(document.getElementById(id).style.display == 'none'){
        document.getElementById(id).style.display = 'block';
    }
    else document.getElementById(id).style.display = 'none';
}

function requireOther(){
    if(document.getElementById('min').value != null) document.getElementById('max').getAttribute("required");
    if(document.getElementById('max').value != null) document.getElementById('min').getAttribute("required");
}
    
