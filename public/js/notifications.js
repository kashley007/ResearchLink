$("#notificationLink").click(function(){
    $("#notificationContainer").fadeToggle(300);
    $("#notification_count").fadeOut("slow");
    return false;
});

//Document Click hiding the popup 
$(document).click(function(){
    $("#notificationContainer").hide();
});

//Popup on click
$("#notificationContainer").click(function(){
    return false;
});

// Delete notification 
$('.deleteNotification').click(function(){ 
    var dataId = $(this).attr('name'); 

    $(this.parentNode.parentNode).fadeOut( "fast" );          
    $.ajax({
        url: '{{ url('notification/delete') }}' + '/' + dataId,
        type: "post",
        data: {'_token': $('input[name=_token]').val()},
    });      
});

//Mark notification as read
$('.markRead').click(function(){ 
    var link = $(this);
    var dataId = $(this).attr('name'); 
    var div = $(this).parent().parent();     
    $.ajax({
        url: '{{ url('notification/read') }}' + '/' + dataId,
        type: "post",
        data: {'_token': $('input[name=_token]').val()},
        success: function(data){
            $(link).fadeOut(200, function(){
                $(link).replaceWith('<span style="display:none;" id="readReplace"><i class="fa fa-check" aria-hidden="true"></i>&nbspRead</span>');
                    $('#readReplace').fadeIn("slow");
            });
        }
    });      
});