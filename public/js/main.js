

var url = 'http://proyecto-laravel.com.devel'
window.addEventListener("load", function(){
    $('.btn-like').css('cursor','pointer');
    $('.btn-dislike').css('cursor','pointer');  
    $(document).on("click", ".btn-like", function(){
       
       
        
         $.ajax({
             url: url+'/dislike/'+$(this).data('id'),
             type: 'GET',
             success: function(response){
                 if(response.like){
                     var id_image = response.image_id;
                     console.log(id_image);
                    $("[id="+id_image+"]" ).text(response.count_likes);
                }
            }
        });    
        $(this).addClass("btn-dislike").removeClass("btn-like");
        $(this).attr("src" , url+"/img/heart-gray.png");   
    } );
    
    $(document).on("click", ".btn-dislike", function(){
  
        $.ajax({
            url: url+'/like/'+$(this).data('id'),
            type: 'GET',
            success: function(response){
                
                if(response.like){
                    var id_image = response.image_id;
                    console.log(id_image);
                    $("[id="+id_image+"]" ).text(response.count_likes);
                    
                }
            }
        });  
        $(this).attr("src" , url+"/img/heart-red.png");
        
        $(this).addClass("btn-like").removeClass("btn-dislike");
        
        
    } ); 
})









//console.log(window.name);
/*  if (window.name == "reloader") { window.name = ""; location.reload(); }window.onbeforeunload = function() { window.name = "reloader"; }   */