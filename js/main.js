jQuery(document).ready(function($){
    $('.delMess').bind('click',function(e){
        event.preventDefault();
        var id = $(this).attr('id').split('_');
        $.ajax({
            type: "POST",
            url: "messageAjax.php",
            data: { id: id[1], action:'delete'}
        }).done(function( id ) {
            //alert( "Data Saved: " + msg );
            //console.log(id);
            $('#mess_'+id.trim()).remove();
            //console.log(id);
        });
    });
	$('.doit').click(function(){
		console.log(this.attr('data-param'));
		return false;
		// $.ajax({
        //    type: "POST",
        //    url: "FleetAjax.php?action=send",
        //    data: { id: id[1], action:'read'}
        //}).done(function( id ) {
        //    //alert( "Data Saved: " + msg );
        //    //console.log(id);
        //    $('#rMess_'+id.trim()).html('<img src="styles/images/false.png" />');
        //    //console.log(id);
        //});
	});
    $(".message").click(function(){
        $(this).colorbox({width:700});
        var id = $(this).attr('id').split('_');
        //console.log(id);
        $.ajax({
            type: "POST",
            url: "messageAjax.php",
            data: { id: id[1], action:'read'}
        }).done(function( id ) {
            //alert( "Data Saved: " + msg );
            //console.log(id);
            $('#rMess_'+id.trim()).html('<img src="styles/images/false.png" />');
            //console.log(id);
        });
    });
	$('.recolte').click(function(){
		$.ajax({
            type: "POST",
            url: $(this).attr("href")
        }).done(function( id ) {
            //alert( "Data Saved: " + msg );
            //console.log(id);
            
            //console.log(id);
        });
		return false;
	});
});