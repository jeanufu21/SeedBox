$( document ).on( "click", "#submit", function() {
           
           var e = $("#login").val();
           var f = $("#senha").val();

           var data = $("form").serializeArray();

            // $.ajax({
            //     type: "POST",
            //     url: "http://localhost/release/Gerenciador/wservice.php/login",
            //     crossDomain: true,
            //     // beforeSend: function() {
            //     //     $.mobile.loading('show')
            //     // },
            //     // complete: function() {
            //     //     $.mobile.loading('hide')
            //     // },
            //     data: {login:e, senha:f},
            //     // data:data,
            //     dataType: 'json',
            //     success: function(response) {
            //         //console.error(JSON.stringify(response));
            //         alert(response);
            //     },
            //     error: function() {
            //         //console.error("error");
            //         alert('Not working!');
            //     }
            // });


            // teste para o get nos campos

            // $.ajax({
            //     type: "GET",
            //     url: "http://localhost/release/Gerenciador/wservice.php/campos",
            //     crossDomain: true,
            //     // beforeSend: function() {
            //     //     $.mobile.loading('show')
            //     // },
            //     // complete: function() {
            //     //     $.mobile.loading('hide')
            //     // },
            //     // data: {login:e, senha:f},
            //     // data:data,
            //     dataType: 'json',
            //     success: function(response) {
            //         //console.error(JSON.stringify(response));
            //         // alert(response);
            //     },
            //     error: function() {
            //         //console.error("error");
            //         // alert('Not working!');
            //     }
            // });

            $.ajax({
                type: "POST",
                url: "http://localhost/release/Gerenciador/wservice.php/ensaios",
                crossDomain: true,
                // beforeSend: function() {
                //     $.mobile.loading('show')
                // },
                // complete: function() {
                //     $.mobile.loading('hide')
                // },
                data: {cod_campo:e, cod_user:f},
                // data:data,
                dataType: 'json',
                success: function(response) {
                    //console.error(JSON.stringify(response));
                    alert(response);
                },
                error: function() {
                    //console.error("error");
                    alert('Not working!');
                }
            });
});