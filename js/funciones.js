$(document).ready(function() {

$.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '< Ant',
 nextText: 'Sig >',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'dd/mm/yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);

$("#fecha").datepicker();

});


function setCupos(id, cantidad){

        if(cantidad > 0){
                $("#truncate").css("display","block");
                $("#"+id).css("display","block");
                $("#procesar").attr("disabled", false);
        }else{
                $("#truncate").css("display","none");
                $("#procesar").attr("disabled", false);
        }

        if(cantidad == 5){
                $("#"+id).text("- Se ha alcanzado el máximo de cupos -");
                $("#procesar").attr("disabled", true);
        }else{
                if(5-cantidad == 1){
                        $("#"+id).text("- Queda "+(5-cantidad)+" cupo -");
                }else{
                        $("#"+id).text("- Quedan "+(5-cantidad)+" cupos -");
                }
        }
}



function revisarDigito(dvr){
dv = dvr + ""

if( dv != '0' && dv != '1' && dv != '2' && dv != '3' && dv != '4' && dv != '5' && dv != '6' && dv != '7' && dv != '8' && dv != '9' && dv != 'k'  && dv != 'K')
{

        alert("Debe ingresar un digito verificador valido");

        window.document.form1.rut.focus();

        window.document.form1.rut.select();

        return false;

}

return true;

}

 

function revisarDigito2(crut){

        largo = crut.length;

        if(largo<2)

        {

                alert("Debe ingresar el rut completo")

                window.document.form1.rut.focus();

                window.document.form1.rut.select();

                return false;

        }

        if(largo>2)

                rut = crut.substring(0, largo - 1);

        else

                rut = crut.charAt(0);

        dv = crut.charAt(largo-1);

        revisarDigito( dv );

 

        if ( rut == null || dv == null )

                return 0

                var dvr = '0'

                suma = 0

                mul  = 2

 

                for (i= rut.length -1 ; i >= 0; i--){

                        suma = suma + rut.charAt(i) * mul

                        if (mul == 7)

                                mul = 2

                                else

                                        mul++

                }

                res = suma % 11

                if (res==1)

                        dvr = 'k'

                        else if (res==0)

                                dvr = '0'

                                else

                                {

                                        dvi = 11-res

                                        dvr = dvi + ""

                                }

                                if ( dvr != dv.toLowerCase() )

                                {

                                        alert("EL rut es incorrecto")

                                        window.document.form1.rut.focus();

                                        window.document.form1.rut.select();

                                        return false

                                }

 

                                return true

}

 

function Rut(texto)

{

        var tmpstr = "";

        for ( i=0; i < texto.length ; i++ )

                if ( texto.charAt(i) != ' ' && texto.charAt(i) != '.' && texto.charAt(i) != '-' )

                        tmpstr = tmpstr + texto.charAt(i);

                texto = tmpstr;

        largo = texto.length;

 

        if ( largo < 2 )

        {

                alert("Debe ingresar el rut completo")

                window.document.form1.rut.focus();

                window.document.form1.rut.select();

                return false;

        }

 

        for (i=0; i < largo ; i++ )

        {

                if ( texto.charAt(i) !="0" && texto.charAt(i) != "1" && texto.charAt(i) !="2" && texto.charAt(i) != "3" && texto.charAt(i) != "4" && texto.charAt(i) !="5" && texto.charAt(i) != "6" && texto.charAt(i) != "7" && texto.charAt(i) !="8" && texto.charAt(i) != "9" && texto.charAt(i) !="k" && texto.charAt(i) != "K" )

                {

                        alert("El valor ingresado no corresponde a un R.U.T valido");

                        window.document.form1.rut.focus();

                        window.document.form1.rut.select();

                        return false;

                }

        }

 

        var invertido = "";

        for ( i=(largo-1),j=0; i>=0; i--,j++ )

                invertido = invertido + texto.charAt(i);

        var dtexto = "";

        dtexto = dtexto + invertido.charAt(0);

        dtexto = dtexto + '-';

        cnt = 0;

 

        for ( i=1,j=2; i<largo; i++,j++ )

        {

                //alert("i=[" + i + "] j=[" + j +"]" );

                if ( cnt == 3 )

                {

                        dtexto = dtexto + '.';

                        j++;

                        dtexto = dtexto + invertido.charAt(i);

                        cnt = 1;

                }

                else

                {

                        dtexto = dtexto + invertido.charAt(i);

                        cnt++;

                }

        }

 

        invertido = "";

        for ( i=(dtexto.length-1),j=0; i>=0; i--,j++ )

                invertido = invertido + dtexto.charAt(i);

 

        window.document.form1.rut.value = invertido.toUpperCase()

 

        if(revisarDigito2(texto))

                return true;

        return false;

}