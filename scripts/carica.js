function OnJson(json){
    const intestazione=document.createElement('div');
    intestazione.textContent="Questo è un esempio di ricerca effettuata tramite parole chiave possibile dopo aver effetuato il login";
    const nuova_ricetta=document.querySelector(".nuova_vista");
    nuova_ricetta.appendChild(intestazione);
    for(let i=0;i<2;i++){
       const hit=json.hits[i];
       const titolo=hit.recipe.label;
       const ingredienti=hit.recipe.ingredients;
       const img=hit.recipe.images.REGULAR.url;

       const contenuto=document.createElement("div");
       contenuto.classList.add("contenuto");
       
       const title=document.createElement("div");
       title.textContent=titolo;
       
       const Box1=document.createElement("div");
       Box1.classList.add("Box1");
       
       const immagine=document.createElement("img");
       immagine.src=img;
       
       const Box2=document.createElement("div");
       Box2.classList.add("Box2");
       
       for(let p=0;p<ingredienti.length;p++){
           Box2.innerHTML=Box2.innerHTML+ingredienti[p].text+"<br/>";
       }
      
       Box1.appendChild(title);
       Box1.appendChild(immagine);
       contenuto.appendChild(Box1);
       contenuto.appendChild(Box2);
       const section=document.createElement("section");
       section.classList.add("Item");
       section.appendChild(contenuto);
       nuova_ricetta.appendChild(section);
       
    }
}
function OnResponse(response){
    return response.json();
   }
fetch('Carica_esempio.php').then(OnResponse).then(OnJson);