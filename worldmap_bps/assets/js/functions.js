//backend
//add new row on table
jQuery(document).on("click","input.btn_newcountryrow, input.btn_newccaterow",function() {
  var clone_row = jQuery('table.wp-list-table tbody tr:first').clone();
  clone_row.find("input[type='text']").val("");
  clone_row.find("input[type='hidden']").val("");
  clone_row.find("textarea").val("");
  clone_row.find(".record_created").html("");
  clone_row.find(".add_panel").show();
  clone_row.find(".edit_panel").hide();
  jQuery('table.wp-list-table').prepend(clone_row);
});

//delete new row on table
jQuery(document).on("click","input.btn_del",function() {
  jQuery(this).parents("tr").remove();
});

//remove country data
jQuery(document).on("click","input.btn_ccate_remove",function() {
  var r = confirm("Are you sure you want to delete this record?");
  if (r == true) {
    var this_row = jQuery(this).parents("tr");
    var cate_id = this_row.find("input.cate_id").val();

    jQuery.ajax({
        url: "../wp-admin/admin-ajax.php",
        dataType : "json",
        data: {
            action: 'del_cate', 'cate_id' : cate_id
        },
        type: 'POST',
        success: function(response) {
          console.log(response);
          this_row.remove();
        }
    });
  }
});

//add/edit country cate
jQuery(document).on("click","input.btn_ccate_add, input.btn_ccate_edit",function() {
  var this_row = jQuery(this).parents("tr");
  var cate_slug = this_row.find("input.cate_slug").val();
  var cate_id = this_row.find("input.cate_id").val();
  var cate_title = this_row.find("input.cate_title").val();
  var map_color = this_row.find("input.map_color").val();
  var region_selected = this_row.find("input.region_selected").val();
  var marker = this_row.find("input.marker").val();



  var action = 'others';
  if (jQuery(this).hasClass("btn_ccate_add") && (cate_id == "" || cate_id == null)) {
    action = "add";
  } else if (jQuery(this).hasClass("btn_ccate_edit") && cate_id > 0) {
    action = "edit";
  }

  if (action == "add" || action == "edit") {
    jQuery.ajax({
        url: "../wp-admin/admin-ajax.php",
        dataType : "json",
        data: {
            action: action+'_cate', 'cate_id' : cate_id, 'cate_slug' : cate_slug, 'cate_title' : cate_title, 'map_color' : map_color, 'region_selected' : region_selected, 'marker' : marker
        },
        type: 'POST',
        success: function(response) {
          console.log(response);
          if (action == "add") {
            this_row.find('input.cate_id').val(response.new_id);
          }
          this_row.find('div.record_created').html(response.time_created);
          this_row.find('.add_panel').hide();
          this_row.find('.edit_panel').show();
        }
    });
  } else {
    alert("Some data is missing, please try again later.");
  }
});


//remove country data
jQuery(document).on("click","input.btn_country_remove",function() {
  var r = confirm("Are you sure you want to delete this record?");
  if (r == true) {
    var this_row = jQuery(this).parents("tr");
    var country_id = this_row.find("input.country_id").val();

    jQuery.ajax({
        url: "../wp-admin/admin-ajax.php",
        dataType : "json",
        data: {
            action: 'del_country', 'country_id' : country_id
        },
        type: 'POST',
        success: function(response) {
          console.log(response);
          this_row.remove();
        }
    });
  }
});

//add/edit country data
jQuery(document).on("click","input.btn_country_add, input.btn_country_edit",function() {
  var this_row = jQuery(this).parents("tr");
  var cate_slug = this_row.find("select.cate_slug option:selected").text();
  var country_id = this_row.find("input.country_id").val();
  var country_code = this_row.find("input.country_code").val();
  var country_latlon = this_row.find("input.country_latlon").val();
  var country_name = this_row.find("select.country_name option:selected").text();
  var country_title = this_row.find("input.country_title").val();
  var country_content = this_row.find("textarea.country_content").val();
  var country_link = this_row.find("input.country_link").val();

  var action = 'others';
  if (jQuery(this).hasClass("btn_country_add") && (country_id == "" || country_id == null)) {
    action = "add";
  } else if (jQuery(this).hasClass("btn_country_edit") && country_id > 0) {
    action = "edit";
  }

  if (action == "add" || action == "edit") {
    jQuery.ajax({
        url: "../wp-admin/admin-ajax.php",
        dataType : "json",
        data: {
            action: action+'_country', 'country_id' : country_id, 'country_code' : country_code, 'country_latlon' : country_latlon, 'country_name' : country_name, 'country_title' : country_title, 'country_content' : country_content, 'country_link' : country_link, 'cate_slug' : cate_slug
        },
        type: 'POST',
        success: function(response) {
          console.log(response);
          if (action == "add") {
            this_row.find('input.country_id').val(response.new_id);
          }
          this_row.find('div.record_created').html(response.time_created);
          this_row.find('.add_panel').hide();
          this_row.find('.edit_panel').show();
        }
    });
  } else {
    alert("Some data is missing, please try again later.");
  }
});



//update country code by changing the selectbox
jQuery(document).on('change', '.country_name', function(){
  jQuery(this).parents("tr").find("input.country_code").val(jQuery(this).find(":selected").val());
  jQuery(this).parents("tr").find("input.country_latlon").val(jQuery(this).find(":selected").attr('data-loc'));
});
