var prefix = "TabbedInfo";
  $(function()
  {
    $("#"+prefix).addClass("ajax__tab_container");
    $("#"+prefix).addClass("ajax__tab_default");

    $("#"+prefix+"_header").addClass("ajax__tab_header");
    $("#"+prefix+"_body").addClass("ajax__tab_body");

    $("[id^='__tab_"+prefix+"']").addClass("ajax__tab");
    $("[id^='__tab_"+prefix+"'] h3").wrap('<span class="ajax__tab_outer"></span>');
    $("[id^='__tab_"+prefix+"'] h3").wrap('<span class="ajax__tab_inner"></span>');
    $("[id^='__tab_"+prefix+"'] h3").wrap(function(){ return '<a class="ajax__tab_tab ajax__tab" id="'+$(this).parent().parent().parent().attr('id')+'" href="#" style="text-decoration:none;"></a>'; });

    $("a.ajax__tab").on(
    {
      mouseover: function(){ $("span#"+$(this).attr('id')).addClass("ajax__tab_hover"); },
      mouseout: function(){ $("span#"+$(this).attr('id')).removeClass("ajax__tab_hover"); },
      click: function(event)
      {
        event.preventDefault();
        if($("span#"+$(this).attr('id')).hasClass("ajax__tab_active")) return;

        $("span[id^='__tab_"+prefix+"']").removeClass("ajax__tab_active");
        $(".ajax__tab_panel").hide();
        $("span#"+$(this).attr('id')).addClass("ajax__tab_active");
        $(".ajax__tab_panel#"+$(this).attr('id').substring(6)).show();
      }
    });

    $("span[id^='__tab_"+prefix+"']").first().addClass("ajax__tab_active");
  });