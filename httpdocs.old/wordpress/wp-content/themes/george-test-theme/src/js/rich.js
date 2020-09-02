/*!
 * FireCask - Starter theme
 * R.Jones/J.Olczak
 * https://firecask.com
 */

/* globals jQuery, ajaxurl, google, $, */

// var Helpers = {
// 	slugify: function(text) {
// 		return text.toString().toLowerCase()
// 			.replace(/\s+/g, '-')
// 			.replace(/[^\w\-]+/g, '')
// 			.replace(/\-\-+/g, '-')
// 			.replace(/^-+/, '')
// 			.replace(/-+$/, '');
// 	}
// };

// var Contact = {
// 	settings: {
// 		map: null,
// 		$markers: jQuery('.marker'),
// 		markers: [],
// 		markers_obj: [],
// 		disable_controls: true,
// 		draggable: false,
// 		open_window: null,
// 		$explore: jQuery('.map-explore'),
// 		$window: jQuery(window)
// 	},

// 	init: function() {
// 		Contact.initMap();
// 		Contact.bindEvents();
// 	},

// 	bindEvents:function() {
// 		Contact.settings.$explore.on('click', Contact.toggleMapControls);
// 		Contact.settings.$window.on('resize', Contact.updateMapZoom);
// 	},

// 	initMap: function() {
// 		var map_centre, map_zoom, map_options,
// 			style_options = [
// 				{
// 					"stylers": [
// 						{
// 							"saturation": -45
// 						},
// 						{
// 							"lightness": -30
// 						}
// 					]
// 				},
// 				{
// 					"featureType": "poi.business",
// 					"stylers": [
// 						{
// 							"visibility": "off"
// 						}
// 					]
// 				},
// 				{
// 					"featureType": "poi.park",
// 					"elementType": "labels.text",
// 					"stylers": [
// 						{
// 							"visibility": "off"
// 						}
// 					]
// 				},
// 				{
// 					"featureType": "water",
// 					"stylers": [
// 						{
// 							"saturation": -75
// 						},
// 						{
// 							"lightness": -15
// 						}
// 					]
// 				}
// 			];

// 		map_centre  = new google.maps.LatLng(52.8027739,-1.5348807);
// 		map_zoom    = Contact.updateMapZoom();

// 		map_options = {
// 			zoom: map_zoom,
// 			mapTypeControl: false,
// 			center: map_centre,
// 			draggable: Contact.settings.draggable,
// 			disableDefaultUI: Contact.settings.disable_controls,
// 			mapTypeControlOptions: {
// 				mapTypeIds: ['roadmap', 'satellite', 'hybrid', 'terrain', 'styled_map']
// 			},
// 			mapTypeId: 'styled_map'
// 		};
// 		Contact.settings.map = new google.maps.Map(document.getElementById('map'), map_options);

// 		var custom_map_type = new google.maps.StyledMapType(style_options, { name: 'Styled Map' });
// 		Contact.settings.map.mapTypes.set('styled_map', custom_map_type);

// 		Contact.initMarkers();
// 		return false;
// 	},

// 	initMarkers: function() {
// 		var infowindow = null, marker;

// 		Contact.settings.$markers.each(function(){

// 			var marker_image = new google.maps.MarkerImage( jQuery(this).data('icon') ,
// 				new google.maps.Size(38, 38),
// 				new google.maps.Point(0, 0),
// 				new google.maps.Point(19, 19));

//             marker = new google.maps.Marker({
//                 position: new google.maps.LatLng(jQuery(this).data('lat'), jQuery(this).data('lng')),
//                 map: Contact.settings.map,
//                 animation: google.maps.Animation.DROP,
//                 icon: marker_image
//             });
// 			Contact.settings.markers_obj.push(marker);

// 			google.maps.event.addListener(marker, 'click', Contact.markerListener(marker, 'click', this));

// 		});
// 	},

// 	markerListener: function(pointer, bubble, details){
// 		return function() {
// 			if(Contact.settings.open_window) {
// 				Contact.settings.open_window.close();
// 				Contact.settings.open_window = null;
// 			}

// 			bubble = new google.maps.InfoWindow({
// 				content: '<div class="info-content">'+jQuery(details).data('addr')+'</div>',
// 				maxWidth: 500
// 			});

// 			bubble.open(Contact.settings.map, pointer);
// 			Contact.settings.open_window = bubble;
// 		};
// 	},

// 	updateMapZoom: function(e) {
// 		var win = jQuery(window),
// 			width = win.width();

// 		if(width > 800) {
// 			if(Contact.settings.map !== null) {
// 				Contact.settings.map.setZoom(7);
// 			} else {
// 				return 7;
// 			}
// 		} else if((width < 800)&&(width > 350)) {
// 			if(Contact.settings.map !== null) {
// 				Contact.settings.map.setZoom(6);
// 			} else {
// 				return 6;
// 			}
// 		} else {
// 			if(Contact.settings.map !== null) {
// 				Contact.settings.map.setZoom(5);
// 			} else {
// 				return 5;
// 			}
// 		}
// 	},

// 	toggleMapControls: function(e) {
// 		e.preventDefault();
// 		if(Contact.settings.disable_controls) {
// 			Contact.settings.disable_controls = false;
// 			Contact.settings.draggable = true;
// 		} else {
// 			Contact.settings.disable_controls = true;
// 			Contact.settings.draggable = false;
// 		}
// 		Contact.initMap();
// 	}

// };

// // Init all
// jQuery(function(){
// 	'use strict';
// 	if(jQuery('.page-template-template-contact').length){Contact.init();}
// });