const spotify_url="https://api.spotify.com/v1/browse/new-releases";
const spotify_token='https://accounts.spotify.com/api/token';
client_id="dd29f8370e0d463c9b9f85f2753fc3a8";
client_secret="d697efff6c854e128b796cf46962505c";


function MostraRicerca(event){
    const form=document.querySelector("form");
    form.classList.remove("Hidden");
    event.currentTarget.addEventListener("click",NascondiRicerca);
    event.currentTarget.removeEventListener("click",MostraRicerca);
}
function NascondiRicerca(event){
    const Ricerca=document.querySelector("form");
    Ricerca.classList.add("Hidden");
    event.currentTarget.removeEventListener("click",NascondiRicerca);
    event.currentTarget.addEventListener("click",MostraRicerca);
}
function OnResponse(response){
 return response.json();
}

function torna(event){
    event=event.currentTarget;
    const nuova_ricetta=document.querySelector(".nuova_vista");
    nuova_ricetta.innerHTML='';
    nuova_ricetta.classList.add("Hidden");
    const titolo_ricetta=document.querySelector("#titolo");
    titolo_ricetta.textContent="Ricette Unict";
    event.classList.add("Hidden");
    const Vista_Spotify=document.querySelector(".Spotify");
    Vista_Spotify.classList.add("Hidden");
}


const Cerca = document.querySelector('a.button');
Cerca.addEventListener("click",MostraRicerca);
//document.querySelector('.username input').addEventListener('blur',checkUsername);
//document.querySelector('.password input').addEventListener('blur',checkPassword);

