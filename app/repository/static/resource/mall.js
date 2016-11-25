var deferred=lml.deferred;
var defj=lml.createDeferred();
defj.then(function(){
	lml.loadJs.competeLoad([
		'https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js',
		'https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.0.min.js',
		'https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js',
		/*'https://cdn.jsdelivr.net/jquery/1.11.0/jquery.min.js',*/
		'https://code.jquery.com/jquery-1.11.0.min.js'
		], function(){
			defj.promise();
	}, function(){
		$.noConflict();
	});
});
defj.promise();


defj.then(function(){
	
	defj.promise();
});



