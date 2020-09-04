IniciarConexion();

    var ws;
    function IniciarConexion() {
        ws = new WebSocket('ws://achex.ca:4010');
        ws.onopen = function () {
            ws.send('{"setID":"miCalendarrio","passwd":"2020"}');
        }
        ws.onmessage = function (data) {
            console.log("data completa")
            console.log(data)
            let MensajesObtenidos = data.data;
            let objeto = jQuery.parseJSON(MensajesObtenidos);
            console.log("mensajesobetenidos+")
            console.log(MensajesObtenidos)
            console.log("objeto a continuacion parseJson")
            console.log(objeto.NombreU)
            if (objeto.NombreU != null) {
               // console.log('hola')
               // alert('hola')
               calendar.refetchEvents();
            }
        }
        ws.onclose = function () {
            alert('conexion cerrada');
        }
    }



    ws.send('{"to":"miCalendarrio","NombreU":"' + data + '"}');