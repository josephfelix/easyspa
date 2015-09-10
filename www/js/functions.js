var MathEasySpa = {
	rad: function(x)
	{
		return x * Math.PI / 180;
	},
	calculateDistance: function(p1, p2)
	{
		var R = 6378137;
		var dLat = MathEasySpa.rad(p2.latitude - p1.latitude);
		var dLong = MathEasySpa.rad(p2.longitude - p1.longitude);
		var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
			Math.cos(MathEasySpa.rad(p1.latitude)) * Math.cos(MathEasySpa.rad(p2.latitude)) *
			Math.sin(dLong / 2) * Math.sin(dLong / 2);
		var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
		var d = R * c;
		return d;
	}
};