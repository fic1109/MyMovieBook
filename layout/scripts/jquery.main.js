var apiURL="https://www.omdbapi.com/";
var apiKey="apikey=315eefee";

$(document).ready(function () {
	var $Form = $('#formafilm'), $Container = $('#MovieInfo');
	$Container.hide();
	 
	$($Form).submit(function(e) {
		e.preventDefault();
		var sUrl, sMovie, oData;
    	sMovie=document.getElementById('film').value;
    	sUrl=apiURL + '?' + apiKey + '&t=' + sMovie;
    	$.ajax(sUrl, {
    	    complete: function(p_oXHR, p_sStatus) {
    	        oData = $.parseJSON(p_oXHR.responseText);
    	        console.log(oData);
	
				if (oData.Response === "False") {
					$Container.hide();
				} else {
    				document.getElementById('title').value=oData.Title;
    				document.getElementById('year').value=oData.Year;
    				document.getElementById('runtime').value=oData.Runtime;
    				document.getElementById('genre').value=oData.Genre;
    				document.getElementById('directors').value=oData.Director;
    				document.getElementById('actors').value=oData.Actors
    				document.getElementById('plot').value=oData.Plot;
    				document.getElementById('language').value=oData.Language;
    				document.getElementById('poster').src=oData.Poster;
    				document.getElementById('poster2').value=oData.Poster;

					$Container.show();
				}
        	}
    	});
	});

$(document.getElementById('Watched')).click(function(f) {
          console.log('Na pravom mjestu sam');
		  f.preventDefault();
            var clickBtnValue = $(this).val();
            var ajaxurl = 'unesibazu.php';
            data =  {'action': clickBtnValue};
            $.post(ajaxurl,{
                Title: document.getElementById('title').value ,
                Year: document.getElementById('year').value ,
                Runtime: document.getElementById('runtime').value ,
                Genre: document.getElementById('genre').value ,
                Director: document.getElementById('directors').value ,
                Actors: document.getElementById('actors').value ,
                Plot: document.getElementById('plot').value ,
                Language: document.getElementById('language').value ,
                Poster: document.getElementById('poster2').value ,
                Watched: 1
            },
            function(data){
            });
            alert("Uspješno spremljeno u Watched!");
        });

$(document.getElementById('Wishlist')).click(function(f) {
          console.log('Na pravom mjestu sam');
          f.preventDefault();
            var clickBtnValue = $(this).val();
            var ajaxurl = 'unesibazu.php';
            data =  {'action': clickBtnValue};
            $.post(ajaxurl,{
                Title: document.getElementById('title').value ,
                Year: document.getElementById('year').value ,
                Runtime: document.getElementById('runtime').value ,
                Genre: document.getElementById('genre').value ,
                Director: document.getElementById('directors').value ,
                Actors: document.getElementById('actors').value ,
                Plot: document.getElementById('plot').value ,
                Language: document.getElementById('language').value ,
                Poster: document.getElementById('poster2').value ,
                Watched: 0
            },
            function(data){

            });
            alert("Uspješno spremljeno u Wishlist!");
        });
});