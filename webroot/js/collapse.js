  $(function() {
    var icons = {
      header: "ui-icon-carat-1-e",
      activeHeader: "ui-icon-carat-1-s"
    };
    $( ".collapse2" ).accordion({
      collapsible: true,
      icons: icons,
      animate: 200
    });
  });