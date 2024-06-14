Voici mon fichier bjs2-js-lib.js : // Small wrapper around fetch()
// Adds responseType (json,text,...), get, post, postJson options.
// Rejects promise when http status is not ok
// Decodes and returns ok response in promise.
function simple_fetch(url,options){
    const responseType=options?.responseType ?? 'json';
    if(options?.responseType){delete options.responseType;}

    if(options?.get){
        for(const [key, value] of Object.entries(options.get)) {
            if(typeof value!=='number' && typeof value!=='string'){
                return Promise.reject('Error: simple_fetch: value for "'+key+'" is not of allowed type.');
            }
        }
        options.method='GET';
        url+=url.includes('?') ? '&' : '?';
        url+=(new URLSearchParams(options.get)).toString();
        delete options.get;
    }

    if(options?.post){
        options.method='POST';
        const data = new FormData();
        for(const [key, value] of Object.entries(options.post)) {
            if(typeof value!=='number' && typeof value!=='string'){
                return Promise.reject('Error: simple_fetch: value for "'+key+'" is not of allowed type.');
            }
            data.append(key,value);
        }
        delete options.post;
        options.body=data;
    }

    if(options?.postJson){
        options.method='POST';
        if(!options.headers){options.headers={};}
        options.headers['Accept']='application/json';
        options.headers['Content-Type']='application/json';
        options.body=JSON.stringify(options.postJson);
        delete options.postJson;
    }

    //console.log(url,options);
    return fetch(url,options).then(response=>{
        if(!response.ok){
            return response[responseType]().then((r)=>{
                return Promise.reject(r);
            });
        }
        return response[responseType]();
    });
}

function range_ta_chambre(nom,proba=.5){
    return new Promise((resolve,reject)=>{
        console.log(nom+': Je te promets de ranger ma chambre');
        if(Math.random()>=proba){
            setTimeout(()=>{
                const div=document.createElement('div');
                div.innerHTML='<img src="https://moodle.iutv.univ-paris13.fr/img/bjs2/extraterrestre.svg"/><br/><span class="nom"></span>';
                div.style.textAlign='center';
                div.style.position='absolute';
                div.style.left=(Math.random()*300)+'px';
                div.style.top=(Math.random()*150)+'px';;
                div.querySelector('img').style.width='200px';
                let snom= div.querySelector('.nom');
                snom.textContent=nom;
                snom.style.backgroundColor='green';
                snom.style.color='white';
                snom.style.padding='.5em';
                document.body.append(div);
                setTimeout(()=>{div.remove()},200);
                console.log(nom+": AÃ¯e ... un extraterrestre m'a lancÃ© un rayon paralysant et je n'ai pas pu ranger.");
                reject('DÃ©solÃ©');
            },3000);
        }
        else {
            setTimeout(()=>{
                console.log(nom+": C'est rangÃ©!");
                resolve('Ok!');
            },2000);
        }
    });
}

function attendre(d){
    return new Promise((resolve,reject)=>{
        setTimeout(()=>{
            resolve('Attende de '+d+'ms finie');
        },d);
    });
}
et index.html : <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <title>RH employées</title>
    <link rel="stylesheet" href="rh_employee.css" />
    <script src="bjs2-js-lib.js"></script>
    <script src="rh_employee.js"></script>

</head>
<body>
    <h1>Site de RH employées</h1>
    <h2>Liste des employés</h2>
    <div id="employee-list"></div>

    <h2>Ajouter un employé</h2>
    <form id="add-employee-form">
        <label for="name">Nom : </label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="email">email : </label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="phone">Téléphone : </label>
        <input type="text" id="phone" name="phone" required>
        <br>
        <label for="adress">Adresse : </label>
        <input type="text" id="adress" name="adress" required>
        <br><br>
        <button type="submit">Ajouter</button>
    </form>
    <br>
    <a href="supp.html">Supprimer un employé</a>
</body>
</html>
Fait moi rh_employe.js qui ajoute les infos et liste les employe de l'API : http://localhost:6480/tp_api_rest/api/employees sans modifier l'index et bjs2.
