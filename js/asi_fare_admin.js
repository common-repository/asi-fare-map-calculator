jQuery(document).on('click','.rem',function(){
   var id = jQuery(this).attr('content');
    //............
    var h1=window.location.pathname;
    var base_url= window.location.origin+h1; 
    base_url=base_url.replace('/wp-admin/admin.php','');
 jQuery.post(base_url+'/wp-admin/admin-ajax.php', {action: 'asi_map_deletecar', id:id},function(data){
    //alert(data);
    	         }); 
});
function addcartype()
{
    alert('Please Do not wrtie currency symbol it already hase been written'); return false;
}