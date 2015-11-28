function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}
$(document).ready(function()
{
	/* if ( navigator.geolocation )
	{
		navigator.geolocation.getCurrentPosition(
		function( pos )
		{
			var myLatlng = new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude);
			var geocoder = new google.maps.Geocoder();
			geocoder.geocode({'latLng': myLatlng}, function( results, status )
			{
				if ( status == google.maps.GeocoderStatus.OK )
				{
					if ( results.length )
					{
						setCookie('lat', pos.coords.latitude);
						setCookie('lng', pos.coords.longitude);
						setCookie('cidade', results[0].address_components[3].long_name);
						setCookie('estado', results[0].address_components[4].long_name);
					}
				}
			});
		}, 
		function(){}, 
		{enableHighAccuracy: true});
	} */
});