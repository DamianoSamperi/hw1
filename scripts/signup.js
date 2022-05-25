var error=[];
function OnResponse(response){
 return response.json();
}
function checkPassword(){
const input = document.querySelector('.password input');
if(input.value.length<=8){
  const span=input.parentNode.parentNode.querySelector('span').textContent=" Caratteri insufficienti";
  input.classList.add('errore');
  error[0]=false;
  checkform();
}
else{
    input.classList.remove('errore');
    const span=input.parentNode.parentNode.querySelector('span').innerHTML='<br>';
    error[0]=true;
    checkform();
}
}
function checkEmail(){
  const input = document.querySelector('.email input');
  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(input.value)){
    fetch("check_email.php?q="+encodeURIComponent(input.value)).then(OnResponse).then(OnJsonEmail);
    error[1]=true;
    checkform();
  }else{
    const span=input.parentNode.parentNode.querySelector('span').textContent=" Email non valida";
    error[1]=false;
    input.classList.add('errore');
    checkform();
  }


}
function checkcellulare(){
  const input = document.querySelector('.cellulare input');
  if(input.value.length!=10){
    const span=input.parentNode.parentNode.querySelector('span').textContent=" cellulare non valido";
  input.classList.add('errore');
  error[2]=false;
  checkform();
  }else{
    fetch("check_cellulare.php?q="+encodeURIComponent(input.value)).then(OnResponse).then(OnJsonCellulare);
    error[2]=true;
    checkform();
  }
}
function checkUsername(){
 const input = document.querySelector('.username input');
 if(!/^[a-zA-Z0-9_]{4,15}$/.test(input.value)){
       const span=input.parentNode.parentNode.querySelector('span').textContent=" Username non valido";
       input.classList.add('errore');
       error[3]=false;
       checkform();
 }
 else{
     fetch("check_username.php?q="+encodeURIComponent(input.value)).then(OnResponse).then(OnJsonUsername);
     error[3]=true;
     checkform();
 }
}
function OnJsonUsername(json){
  const input = document.querySelector('.username input');
  if(json==true){
     const span=input.parentNode.parentNode.querySelector('span').textContent=" Username gia in uso";
     input.classList.add('errore');
     error[3]=false;
     checkform();
  }else{
    input.classList.remove('errore');
    const span=input.parentNode.parentNode.querySelector('span').innerHTML='<br>';
    error[3]=true;
    checkform();
  }
}
function OnJsonEmail(json){
  const input = document.querySelector('.email input');
  if(json==true){
     const span=input.parentNode.parentNode.querySelector('span').textContent=" Email gia in uso";
     input.classList.add('errore');
     error[1]=false;
     checkform();
  }else{
    input.classList.remove('errore');
    const span=input.parentNode.parentNode.querySelector('span').innerHTML='<br>';
    error[1]=true;
    checkform();
  }
}
function OnJsonCellulare(json){
    const input = document.querySelector('.cellulare input');
  if(json==true){
     const span=input.parentNode.parentNode.querySelector('span').textContent=" Numero gia in uso";
     input.classList.add('errore');
     error[2]=false;
     checkform();
  }else{
    input.classList.remove('errore');
    const span=input.parentNode.parentNode.querySelector('span').innerHTML='<br>';
    error[2]=true;
    checkform();
  }
}
function checkform(){
  const button=document.querySelector('#submit');
if(error[0]==true&&error[1]==true&&error[2]==true&&error[3]==true){
  
  button.disabled=false;
}else
button.disabled=true;
}
document.querySelector('.username input').addEventListener('blur',checkUsername);
document.querySelector('.password input').addEventListener('blur',checkPassword);
document.querySelector('.email input').addEventListener('blur',checkEmail);
document.querySelector('.cellulare input').addEventListener('blur',checkcellulare);
