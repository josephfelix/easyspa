jQuery(document).ready(function(){
	
	"use strict";

   var bardata = [ ["Jan", 0], ["Fev", 0], ["Mar", 0], ["Abr", 0], ["Mai", 0], ["Jun", 0], ["Jul", 0], ["Ago", 0], ["Set", 0], ["Out", 0], ["Nov", 0], ["Dez", 0] ];

	 jQuery.plot("#barchart", [ bardata ], {
		  series: {
            lines: {
              lineWidth: 1  
            },
				bars: {
					show: true,
					barWidth: 0.5,
					align: "center",
               lineWidth: 0,
               fillColor: "#428BCA"
				}
		  },
        grid: {
            borderColor: '#ddd',
            borderWidth: 1,
            labelMargin: 10
		  },
		  xaxis: {
				mode: "categories",
				tickLength: 0
		  }
	 });
    
});