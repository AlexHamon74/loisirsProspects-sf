import './bootstrap.js';
import './styles/app.css';

$(document).ready(function() {
    $('#usersTable').DataTable({
        responsive: true,
        info: false,
    });

});