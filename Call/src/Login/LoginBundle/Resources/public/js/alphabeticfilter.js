
function alphabetSearch(element)
{
	var dicoletter='';
	 if(element==-1){
		 return;
		 }else
			 {
			 
			 var letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
			 dicoletter = letters.charAt(element);
			
			AlphaSelection(dicoletter);
			
			return dicoletter;
			 }
	 		
	 		
	 
};

function AlphaSelection(letter)
{ 
	if(letter != -1){
		
		 
       alert(letter);
       
       $('#Form').submit(function(event) {

    	   // Stop la propagation par défaut
    	   event.preventDefault();

    	   // Récupération des valeurs
    	   var $form = $(this),
    	        term = letter,
    	       //url = $form.attr( "action" );
    	        url:  "{{ path('SampleBundle_route',{'myParam':term}) }}",     // l'URL

    	   // Envoie des données
    	   var posting = $.get( url, { myParam: term } );

    	   // Reception des données et affichage
    	   posting.done(function(data) {
    	     var content = $(data).find('#content');
    	     $('#result').empty().append(content);
    	     alert(data);
    	     
    	    
    	   });
    	  
    	 });
      
      
      
     
		
       
		
	}
	else
		{
		alert("Selection All");
		}
	
};
		
	
	
		
	

