import './bootstrap.js';
import './styles/app.css';

$(document).ready(function() {
    $('#usersTable').DataTable({
        responsive: true,
        language: {
            info: 'Affichage de la page _PAGE_ sur _PAGES_',
            infoEmpty: 'Aucun enregistrement disponible',
            infoFiltered: '(filtré à partir de _MAX_ enregistrements au total)',
            lengthMenu: 'Afficher _MENU_ lignes par page',
            zeroRecords: 'Aucun résultat trouvé',
            search: 'Rechercher:'
        }
    });

});