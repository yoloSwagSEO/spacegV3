jQuery(document).ready(function($){
    $('.nbShip').spinner({min:0});

    $('.addFleet').click(function(event){//Add Ship to fleet
        var shipId = $(this).attr('data-shipId')
        var nbShip = parseInt($('.addShip_'+shipId).val());
        var shipAmount = parseInt($('#amount_'+shipId).val());
        var nbAdd =0;

        if(nbShip > 0){
            if(nbShip > shipAmount){
                nbAdd = shipAmount;
            }else{
                nbAdd = nbShip;
            }
            shipAmount = shipAmount-nbAdd;
            $('#amount_'+shipId).val(shipAmount);
            $('.nb_'+shipId).text(shipAmount);

            if($('.line_'+shipId).length > 0){//Deja présent
                $('.adding_'+shipId).text(parseInt($('.adding_'+shipId).text())+nbAdd);
                $('.fShip_'+shipId).val(parseInt($('.adding_'+shipId).text()));
            }else{//On ajoute la ligne!
                $('#NewfleetList').append(
                    "<tr class=\"line_"+shipId+"\">" +
                    "<td>"+$('.name_'+shipId).text()+"</td>" +
                    "<td class=\"adding_"+shipId+"\">"+nbAdd+"</td>" +
                    "<td>"+$('.speed_'+shipId).text()+"</td>" +
                    "<td>"+$('.conso_'+shipId).text()+"</td>" +
                    "<td>"+$('.capacity_'+shipId).text()+"</td>" +
                    "<td><input type=\"text\"  class=\"nbShipRm rShip_"+shipId+"\"  value=\"0\" style=\"width:35px\"></td>" +
                    "<td><i class=\"sgButtonSmall removeFleet\" data-shipId=\""+shipId+"\" ></i></td>" +
                    "</tr>");
                $('.nbShipRm').spinner({min:0});

                //Ajour au formulaire
                $('#newFleetForm').append("<input type=\"hidden\" class=\"fShip_"+shipId+"\" name=\"ship[s_"+shipId+"]\" value=\""+nbAdd+"\" />");
            }
        }

    });
    $(document).on('click','.removeFleet',function(){//Remove ship to fleet
        var shipId = $(this).attr('data-shipId')
        var nbShip = parseInt($('.rShip_'+shipId).val());
        var shipAmount = parseInt($('.adding_'+shipId).text());
        var nbRem =0;

        if(nbShip > 0){
            console.log(nbShip);
            console.log(shipAmount);
            if(nbShip >= shipAmount){
                console.log('amount ' + shipAmount + " nbEnBas");
                $('.nb_'+shipId).text(parseInt($('.nb_'+shipId).text()) + shipAmount);
                $('.line_'+shipId).remove();
                $('.fShip_'+shipId).remove();
                nbRem = shipAmount;

            }else{

                $('.nb_'+shipId).text(parseInt(nbShip)+ parseInt($('.nb_'+shipId).text()));

                $('.adding_'+shipId).text(parseInt($('.adding_'+shipId).text())-nbShip);
                $('.fShip_'+shipId).val(parseInt($('.adding_'+shipId).text()));


                nbRem = nbShip;

            }


            $('#amount_'+shipId).val(parseInt($('#amount_'+shipId).val())+nbRem);



        }
    });

    $('#submitFleet').click(function(event){
        event.preventDefault();
        $('#newFleetForm').append("<input type=\"hidden\" name=\"fleetName\" value=\""+$('#fleetNameForm').val()+"\" />");

        $('#newFleetForm').submit();
    });
});