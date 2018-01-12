
jQuery(document).on("click",".vmap_mob .clist_header",function(e) {
  jQuery('.vmap_mob .clist_content').hide();
  var this_content = jQuery(this).parent('li').find('.clist_content');
  if (!this_content.is(":visible")) {
    this_content.show();
  }
});

//remove region containers
jQuery(document).on("click","div.vmap",function(e) {
  if (!jQuery(e.target).hasClass('jvectormap-region') && !jQuery(e.target).hasClass('jvectormap-element') && !jQuery(e.target).hasClass('jvectormap-marker')) {
      if (jQuery('.vmap .region_cont').length > 0) {
        jQuery('.vmap .region_cont').remove();
      }
  }
});


function initWorldMap(cate_slug, plugin_url, country_arr, map_color, region_selected_color, marker_color) {
    var pins = [];
    var cate_regions = [];
    var country = {}
    jQuery.each(country_arr, function (i, elem) {
        var pin = {};
        cate_regions.push(elem.country_code.toUpperCase());
        var country_code = elem.country_code.toLowerCase();
        pin['latLng'] = [elem.country_lat, elem.country_lon] ;
        pin['name'] = elem.country_name;
        pin['code'] = elem.country_code;
        pins.push(pin);

        country[elem.country_code.toUpperCase()] = "100";
    });

  jQuery('#'+cate_slug+'_vmap').vectorMap({
    map: 'world_mill',
    backgroundColor: '#fff',
    markers: pins,
    // series: {
    //  regions: [{                              //this is the object for passing country/region data into
    //    scale: [region_selected_color],                    //define the range of color values
    //    normalizeFunction: 'linear',           //define the function that maps data to color range
    //    attribute: 'fill',                     //define the coloration method
    //    values: country                        //define the array of country data
    //  }]
    // },
    markerStyle: {
      initial: {
        //image: plugin_url+"assets/images/marker/red.png",
       fill: marker_color,
       stroke: '#383f47'
      }
    },
    regionStyle: {
        initial: {
          fill: map_color
        },
        hover: {
          fill: region_selected_color
        }
    },
    onMarkerClick: function(event, index) {
      var code = pins[index].code;
      initRegionCont(code, cate_slug, cate_regions, country_arr);
    },
    onRegionClick: function(e, code){
      jQuery('#'+cate_slug+'_vmap path.jvectormap-region').css('fill', map_color);
      jQuery('#'+cate_slug+'_vmap path[data-code='+code+']').css('fill', region_selected_color);
      initRegionCont(code, cate_slug, cate_regions, country_arr);
    }
  });
}


  function initRegionCont(code, cate_slug, cate_regions, country_arr) {
    if (jQuery('#'+cate_slug+'_vmap .region_cont').length > 0) {
      jQuery('#'+cate_slug+'_vmap .region_cont').remove();
    }

    if (jQuery.inArray( code.toUpperCase(), cate_regions ) !== -1) {
        jQuery.each(country_arr, function (i, elem) {
            if (code.toUpperCase() == elem.country_code.toUpperCase()) {
                var content = "<div class='region_cont'>";
                      content += "<div class='region_country'>"+elem.country_name+"</div>";
                      content += "<div class='region_desccont'>";
                          content += "<div class='region_title'>"+elem.country_title+"</div>";
                          content += "<div class='region_desc'>"+elem.country_content+"</div>";
                          if (elem.country_link.length > 0) {
                            content += "<div class='region_link'><a href='"+elem.country_link+"' target='_blank'>visit website >></a></div>";
                          }
                      content += "</div>"
                content += "</div>";
                jQuery('#'+cate_slug+'_vmap').append(content);
                jQuery('#'+cate_slug+'_vmap').css("overflow","inherit");
            }
        });
    }
  }



// function escapeXml(string) {
//   return string.replace(/[<>]/g, function (c) {
//     switch (c) {
//       case '<': return '\u003c';
//       case '>': return '\u003e';
//     }
//   });
// }
//
// jQuery(document).ready(function () {
//   function touch_detect() {
//     return 'ontouchstart' in window || 'onmsgesturechange' in window || navigator.msMaxTouchPoints > 0;
//   }
//
//   var pins = {};
//   var cate_regions = [];
//   jQuery.each(country_arr, function (i, elem) {
//     //console.log(elem);
//       cate_regions.push(elem.country_code.toUpperCase());
//       var country_code = elem.country_code.toLowerCase();
//       pins[country_code] =  escapeXml('<div class="map-pin red"><span>'+elem.country_code+'</span></div>') ;
//   });
//
//   jQuery('#vmap').vectorMap({
//     backgroundColor: '#fff',
//     borderColor: '#333',
//     map: 'world_en',
//     pins: pins,
//     color: '#96ce2f',
//     pinMode: 'content',
//     hoverColor: "#019cbb",
//     selectedColor: '#019cbb',
//     showTooltip: true,
//     selectedRegions: cate_regions,
//     onRegionClick: function (element, code, region) {
//       if (jQuery('#vmap .region_cont').length > 0) {
//         jQuery('#vmap .region_cont').remove();
//       }
//       if (!touch_detect()) {
//         if (jQuery.inArray( code.toUpperCase(), cate_regions ) !== -1) {
//           jQuery.each(country_arr, function (i, elem) {
//             if (jQuery.inArray( code.toUpperCase(), elem.country_code.toUpperCase() ) == -1) {
//                 var content = "<div class='region_cont'>";
//                       content += "<div class='region_country'>"+elem.country_name+"</div>";
//                       content += "<div class='region_desccont'>";
//                           content += "<div class='region_title'>"+elem.country_title+"</div>";
//                           content += "<div class='region_desc'>"+elem.country_content+"</div>";
//                           content += "<div class='region_link'><a href='"+elem.country_link+"' target='_blank'>visit website >></a></div>";
//                       content += "</div>"
//                 content += "</div>";
//                 jQuery('#vmap').append(content);
//                 jQuery('#vmap').css("overflow","inherit");
//             }
//           });
//         }
//
//       }
//     },
//   });
//
//});
