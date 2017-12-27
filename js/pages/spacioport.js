jQuery(document).ready(function($){
    $('.fleetSelectInput').on('click',function(event){
        $('#fleetSelected').val($('.fleetSelectInput:checked').val());
    });
});