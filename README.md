document.addEventListener('DOMContentLoaded', () => {
    const employeeList = document.getElementById('employee-list');
    const addEmployeeForm = document.getElementById('add-employee-form');

    // Fonction pour obtenir et afficher la liste des employés
    function fetchEmployees() {
        simple_fetch('http://localhost:6480/tp_api_rest/api/employees', { responseType: 'json' })
            .then(data => {
                employeeList.innerHTML = ''; // Clear previous list
                data.forEach(employee => {
                    const employeeElement = document.createElement('div');
                    employeeElement.textContent = `Nom: ${employee.name}, Email: ${employee.email}, Téléphone: ${employee.phone}, Adresse: ${employee.address}`;
                    employeeList.appendChild(employeeElement);
                });
            })
            .catch(error => {
                console.error('Erreur lors de la récupération des employés:', error);
                employeeList.innerHTML = 'Erreur lors de la récupération des employés.';
            });
    }

    // Fonction pour ajouter un nouvel employé
    addEmployeeForm.addEventListener('submit', (event) => {
        event.preventDefault();

        const formData = new FormData(addEmployeeForm);
        const employeeData = {
            name: formData.get('name'),
            email: formData.get('email'),
            phone: formData.get('phone'),
            address: formData.get('address')
        };

        simple_fetch('http://localhost:6480/tp_api_rest/api/employees', {
            postJson: employeeData,
            responseType: 'json'
        })
            .then(data => {
                console.log('Employé ajouté:', data);
                fetchEmployees(); // Refresh the employee list
                addEmployeeForm.reset(); // Clear the form
            })
            .catch(error => {
                console.error('Erreur lors de l\'ajout de l\'employé:', error);
                alert('Erreur lors de l\'ajout de l\'employé.');
            });
    });

    // Initialiser la liste des employés
    fetchEmployees();
});

// Définition de la fonction simple_fetch
function simple_fetch(url, options) {
    const responseType = options?.responseType ?? 'json';
    if (options?.responseType) { delete options.responseType; }

    if (options?.get) {
        for (const [key, value] of Object.entries(options.get)) {
            if (typeof value !== 'number' && typeof value !== 'string') {
                return Promise.reject('Error: simple_fetch: value for "' + key + '" is not of allowed type.');
            }
        }
        options.method = 'GET';
        url += url.includes('?') ? '&' : '?';
        url += (new URLSearchParams(options.get)).toString();
        delete options.get;
    }

    if (options?.post) {
        options.method = 'POST';
        const data = new FormData();
        for (const [key, value] of Object.entries(options.post)) {
            if (typeof value !== 'number' && typeof value !== 'string') {
                return Promise.reject('Error: simple_fetch: value for "' + key + '" is not of allowed type.');
            }
            data.append(key, value);
        }
        delete options.post;
        options.body = data;
    }

    if (options?.postJson) {
        options.method = 'POST';
        if (!options.headers) { options.headers = {}; }
        options.headers['Accept'] = 'application/json';
        options.headers['Content-Type'] = 'application/json';
        options.body = JSON.stringify(options.postJson);
        delete options.postJson;
    }

    return fetch(url, options).then(response => {
        if (!response.ok) {
            return response[responseType]().then((r) => {
                return Promise.reject(r);
            });
        }
        return response[responseType]();
    });
}

document.addEventListener('DOMContentLoaded', () => {
    const employeeList = document.getElementById('employee-list');
    const addEmployeeForm = document.getElementById('add-employee-form');

    // Fonction pour obtenir et afficher la liste des employés
    function fetchEmployees() {
        simple_fetch('http://localhost:6480/tp_api_rest/api/employees', { responseType: 'json' })
            .then(data => {
                employeeList.innerHTML = '';
                data.forEach(employee => {
                    const employeeElement = document.createElement('div');
                    employeeElement.textContent = `Nom: ${employee.name}, Email: ${employee.email}, Téléphone: ${employee.phone}, Adresse: ${employee.address}`;
                    employeeList.appendChild(employeeElement);
                });
            })
            .catch(error => {
                console.error('Erreur lors de la récupération des employés:', error);
            });
    }

    // Fonction pour ajouter un nouvel employé
    addEmployeeForm.addEventListener('submit', (event) => {
        event.preventDefault();

        const formData = new FormData(addEmployeeForm);
        const employeeData = {
            name: formData.get('name'),
            email: formData.get('email'),
            phone: formData.get('phone'),
            address: formData.get('address')
        };

        simple_fetch('http://localhost:6480/tp_api_rest/api/employees', {
            postJson: employeeData,
            responseType: 'json'
        })
            .then(data => {
                console.log('Employé ajouté:', data);
                fetchEmployees();
                addEmployeeForm.reset();
            })
            .catch(error => {
                console.error('Erreur lors de l\'ajout de l\'employé:', error);
            });
    });

    // Initialiser la liste des employés
    fetchEmployees();
});

function simple_fetch(url, options) {
    const responseType = options?.responseType ?? 'json';
    if (options?.responseType) { delete options.responseType; }

    if (options?.get) {
        for (const [key, value] of Object.entries(options.get)) {
            if (typeof value !== 'number' && typeof value !== 'string') {
                return Promise.reject('Error: simple_fetch: value for "' + key + '" is not of allowed type.');
            }
        }
        options.method = 'GET';
        url += url.includes('?') ? '&' : '?';
        url += (new URLSearchParams(options.get)).toString();
        delete options.get;
    }

    if (options?.post) {
        options.method = 'POST';
        const data = new FormData();
        for (const [key, value] of Object.entries(options.post)) {
            if (typeof value !== 'number' && typeof value !== 'string') {
                return Promise.reject('Error: simple_fetch: value for "' + key + '" is not of allowed type.');
            }
            data.append(key, value);
        }
        delete options.post;
        options.body = data;
    }

    if (options?.postJson) {
        options.method = 'POST';
        if (!options.headers) { options.headers = {}; }
        options.headers['Accept'] = 'application/json';
        options.headers['Content-Type'] = 'application/json';
        options.body = JSON.stringify(options.postJson);
        delete options.postJson;
    }

    return fetch(url, options).then(response => {
        if (!response.ok) {
            return response[responseType]().then((r) => {
                return Promise.reject(r);
            });
        }
        return response[responseType]();
    });
}

// Small wrapper around fetch()
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
index.html : <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <title>RH employées</title>
    <link rel="stylesheet" href="rh_employee.css" />
    <script src="bjs2-js-lib.js"></script>
</head>
<body>
    <h1>Site de RH employées</h1>
    <h2>Liste des employés</h2>

    <h2>Ajouter un employé</h2>
    <form>

    </form>

    <a href="supp.html">Supprimer un employé</a>
<script src="rh_employee.js"></script>
</body>
</html>
bdd en json sur le lien :http://localhost:6480/tp_api_rest/api/employees :                                     Table "public.employee"
 Column  |          Type          | Collation | Nullable |               Default                
---------+------------------------+-----------+----------+--------------------------------------
 id      | integer                |           | not null | nextval('employee_id_seq'::regclass)
 name    | character varying(24)  |           | not null | 
 email   | character varying(96)  |           |          | 
 phone   | character varying(15)  |           |          | 
 address | character varying(100) |           |          | 
Indexes:
    "employee_pkey" PRIMARY KEY, btree (id)
    "employee_email_key" UNIQUE CONSTRAINT, btree (email)

