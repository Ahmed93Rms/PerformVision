
document.addEventListener('DOMContentLoaded', () => {
    const employeeList = document.getElementById('employee-list');
    const addEmployeeForm = document.getElementById('add-employee-form');

    // Fonction pour obtenir et afficher la liste des employés
    function fetchEmployees() {
        simple_fetch('http://localhost:6480/tp_api_rest/api/employees', { responseType: 'json' })
            .then(data => {
                employeeList.innerHTML = ''; // Clear the list before adding new items
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
            address: formData.get('adress')
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
