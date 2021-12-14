(function($){

  //Show the correct assignment when switching between menu/theme_location
  $( '.ums-form-group input[name=assignment]' ).on( 'change' , function(){
    var assign = $( '.ums-form-group input[name=assignment]:checked' ).val();
    switch( assign ){
      case 'menu':
        $( '.ums-form-group-theme_loc' ).addClass( 'ums-form-group-disabled' );
        $( '.ums-form-group-menu' ).removeClass( 'ums-form-group-disabled' );
        break;
      case 'theme_location':
        $( '.ums-form-group-menu' ).addClass( 'ums-form-group-disabled' );
        $( '.ums-form-group-theme_loc' ).removeClass( 'ums-form-group-disabled' );
        break;
    }
  });



  $( '#ubermenu-sandbox-preview-form button' ).on( 'click' , function(e){
    e.preventDefault();
    $( '.loading' ).addClass( 'loading-show' );
    var data = {
      'security' : ubermenu_sandbox_ajax.security,
  		'action': 'ubermenu_sandbox_preview',
      'assign': $('.ums-form-group-assign input[name=assignment]:checked').val(),
      'menu'  : $( '.ums-form-group-menu select' ).val(),
      'theme_location': $( '.ums-form-group-theme_loc select' ).val(),
  		'config': $( '.ums-form-group-config select' ).val()
  	};
    //console.log( data );
  	$.post( ubermenu_sandbox_ajax.ajax_url, data, function(response) {
      $( '.loading' ).removeClass( 'loading-show' );
  		$('#ubermenu-sandbox-menu-preview').html( response );
      $( '.ubermenu' ).ubermenu();
      init_gmaps();
  	});
  });

  function init_gmaps(){
    //Google Maps
    if(
      typeof google !== 'undefined' &&
      typeof google.maps !== 'undefined' &&
      typeof google.maps.LatLng !== 'undefined') {
        $('.ubermenu-map-canvas').each(function(){

          var $canvas = $( this );
          var dataZoom = $canvas.attr('data-zoom') ? parseInt( $canvas.attr( 'data-zoom' ) ) : 8;

          var latlng = $canvas.attr('data-lat') ?
                  new google.maps.LatLng($canvas.attr('data-lat'), $canvas.attr('data-lng')) :
                  new google.maps.LatLng(40.7143528, -74.0059731);

          var myOptions = {
            zoom: dataZoom,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            center: latlng
          };

          var map = new google.maps.Map(this, myOptions);

          if($canvas.attr('data-address')){
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                'address' : $canvas.attr('data-address')
              },
              function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                  map.setCenter(results[0].geometry.location);
                  latlng = results[0].geometry.location;
                  var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    title: $canvas.attr('data-mapTitle')
                  });
                }
            });
          }
          else{
            //place marker for regular lat/long
            var marker = new google.maps.Marker({
              map: map,
              position: latlng,
              title: $canvas.attr('data-mapTitle')
            });
          }

          var $li = $(this).closest( '.ubermenu-has-submenu-drop' );
          var mapHandler = function(){
            google.maps.event.trigger(map, "resize");
            map.setCenter(latlng);
            //Only resize the first time we open
            $li.off( 'ubermenuopen', mapHandler );
          };
          $li.on( 'ubermenuopen', mapHandler );
        });
    }
  }

})(jQuery);
