$(function() {

  $("main#spapp > section").height($(document).height() - 60);

  var app = $.spapp({pageNotFound : 'error_404'}); // initialize

  app.route({
    view: "login",
    load: "login.html",
  });
  app.route({
    view: "about",
    load: "about.html",
  });

  app.route({
    view: "contact",
    load: "contact.html",
  });

  app.route({
    view: "home",
    load: "home.html"
  });

  app.route({
    view: "favorites",
    load: "favorites.html"
  });

  app.route({
    view: "blog",
    load: "blog.html"
  });

  app.route({
    view: "profile",
    load: "profile.html"
  });

  // run app
  app.run();

});