<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Cita - Mi Sitio Web</title>
    <!-- Enlaces a los estilos CSS -->
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css-citas/agendarCitas.css">
    <!-- Incluye el script de la API de Google -->
    <script src="https://apis.google.com/js/api.js"></script>
    <script>
        function handleClientLoad() {
            gapi.load('client:auth2', initClient);
        }

        function initClient() {
            gapi.client.init({
                apiKey: 'TU_API_KEY',
                clientId: 'TU_CLIENT_ID',
                discoveryDocs: ["https://www.googleapis.com/discovery/v1/apis/calendar/v3/rest"],
                scope: 'https://www.googleapis.com/auth/calendar.events'
            }).then(function () {
                // Escucha el evento de click en el botón "Agendar Cita"
                document.getElementById('agendar-cita-btn').addEventListener('click', handleAuthClick);
            });
        }

        function handleAuthClick() {
            gapi.auth2.getAuthInstance().signIn().then(function () {
                // Una vez autenticado, abre la ventana de creación de evento de Google Calendar
                var event = {
                    'summary': 'Cita médica', // Título del evento
                    'location': 'Dirección del consultorio médico', // Ubicación del evento
                    'description': 'Motivo de la cita: ', // Descripción del evento (aquí puedes incluir el motivo de la cita ingresado por el usuario)
                    'start': {
                        'dateTime': '2024-05-01T09:00:00-07:00', // Fecha y hora de inicio del evento
                        'timeZone': 'America/Los_Angeles'
                    },
                    'end': {
                        'dateTime': '2024-05-01T10:00:00-07:00', // Fecha y hora de fin del evento
                        'timeZone': 'America/Los_Angeles'
                    },
                    'reminders': {
                        'useDefault': false,
                        'overrides': [
                            { 'method': 'email', 'minutes': 24 * 60 },
                            { 'method': 'popup', 'minutes': 10 }
                        ]
                    }
                };

                var request = gapi.client.calendar.events.insert({
                    'calendarId': 'primary', // ID del calendario del usuario
                    'resource': event
                });

                request.execute(function (event) {
                    console.log('Evento creado: ' + event.htmlLink);
                });
            });
        }
    </script>
</head>

<body onload="handleClientLoad()">

    <!-- Encabezado de la página -->
    <?php include "./vistas/inc/headerInicio.php"; ?>

    <main class="full-box main-container">
        <section class="full-box page-content">
            <div class="page-content">
                <!-- Contenido de la página -->
                <h1>Agendar Cita</h1>
                <p>Para agendar una cita, haz clic en el siguiente botón:</p>
                <button id="agendar-cita-btn">Agendar Cita</button>
            </div>
        </section>
    </main>

    <!-- Pie de página -->
    <?php include "./vistas/inc/footerHome.php"; ?>

</body>

</html>
